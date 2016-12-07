---
layout: page
title: IndefiniteObservable
status:
  date: December 4, 2016
  is: Stable
knowledgelevel: L4
library: indefinite-observable
availability:
  - platform:
    name: Android
    label: "indefinite-observable-android as of v1.0.0"
    url: https://github.com/material-motion/indefinite-observable-android
  - platform:
    name: iOS
    label: "indefinite-observable-swift as of v1.0.0"
    url: https://github.com/material-motion/indefinite-observable-swift
  - platform:
    name: JavaScript
    label: "indefinite-observable-js as of v1.0.0"
    url: https://github.com/material-motion/indefinite-observable-js
---

# IndefiniteObservable specification

This is the engineering specification for the `IndefiniteObservable` object.

## Overview

IndefiniteObservable is a minimal implementation of [Observable](http://reactivex.io/rxjs/manual/overview.html)
with no concept of completion or failure.

## Examples

```swift
public final class ValueObserver<V>: Observer<V> {
  public init(_ next: (V) -> Void) {
    self.next = next
  }

  public let next: (V) -> Void
}

public class ValueObservable<V>: IndefiniteObservable<ValueObserver<V>> {
  public final func subscribe(_ next: (V) -> Void) -> Subscription {
    return super.subscribe(observer: ValueObserver(next))
  }
}

let observable = ValueObservable<Int> { observer in
  observer.next(10)
  return noopUnsubscription
}

let _ = observable.subscribe { value in
  print(value)
}

// Example operators:
extension ValueObservable {
  public func _operator<W>(_ work: (ValueObserver<W>, V) -> Void) -> ValueObservable<W> {
    return ValueObservable<W> { observer in
      return self.subscribe(next: observer: ValueObserver<V> {
        work(observer, $0)
      }).unsubscribe
    }
  }

  public func _map<W>(transform: (V) -> W) -> ValueObservable<W> {
    return _operator(op) { observer, value in
      observer.next(transform(value))
    }
  }

  public func _filter(isIncluded: (V) -> Bool) -> ValueObservable<V> {
    return _operator(op) { observer, value in
      if isIncluded(value) {
        observer.next(value)
      }
    }
  }
}
```

## MVP

### Expose a generic abstract Observer type

Define the base Observer type which has a single **channel** called `next`. `next` accepts an
argument of type `V`.

```swift
public protocol Observer<V> {
  func next(value: V)
}
```

### Expose a concrete IndefiniteObservable type

There is a single generic value type: `O`. This is the type of observer that can be provided to the
`subscribe` method. This type should conform to the abstract `Observer` type.

```swift
class IndefiniteObservable<O: Observer> {
}
```

### Expose an unsubscribe function type

The function signature expected to be returned by a `Subscriber`.

```swift
public typealias Unsubscribe = () -> Void
```

### Expose a Subscriber function type

A `Subscriber` receives an observer and can optionally return an `Unsubscribe` method.

```swift
public typealias Subscriber<O> = (O) -> Unsubscribe?
```

### Expose a Subscription object type

A representation of a subscription made by invoking `subscribe` on an `IndefiniteObservable`.

```swift
public protocol Subscription {
  func unsubscribe()
}
```

### Expose an IndefiniteObservable initializer

Requires a `Subscriber` type. Store the subscriber as a private constant variable.

```swift
class IndefiniteObservable<O> {
  public init(subscriber: Subscriber<O>) {
    self.subscriber = subscriber
  }

  private let subscriber: Subscriber<O>
```

### Create a private SimpleSubscription type

Implement a `SimpleSubscription` class that conforms to `Subscription`.

This class should be **private**.

This class should optionally store an `Unsubscribe` function.

When the Subscription is deallocated it should invoke unsubscribe.

```swift
private final class SimpleSubscription: Subscription {
  deinit {
    unsubscribe()
  }

  init(_ unsubscribe: Unsubscribe) {
    _unsubscribe = unsubscribe
  }

  init() {
    _unsubscribe = nil
  }

  func unsubscribe() {
    _unsubscribe?()
    _unsubscribe = nil
  }

  private var _unsubscribe: Unsubscribe?
}
```

### Expose a subscribe API on IndefiniteObservable

Expose a `subscribe` API on `IndefiniteObservable` that accepts an observable and returns a
`Subscription`.

`subscribe` should invoke `self.subscriber` with the provided observer. The returned subscription
is optional and should be wrapped in a `SimpleSubscription` instance before being returned because
`subscribe` must always return a valid Subscription.

```swift
class IndefiniteObservable<O> {
  func subscribe(observer: O) -> Subscription {
    if let subscription = subscriber(observer) {
      return SimpleSubscription(subscription)
    } else {
      return SimpleSubscription()
    }
  }
```
