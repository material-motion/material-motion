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

```
public final class ValueObserver<T> {
  public typealias Value = T

  public init(_ next: (T) -> Void) {
    self.next = next
  }

  public let next: (T) -> Void
}

public class ValueObservable<T>: IndefiniteObservable<ValueObserver<T>> {
  public final func subscribe(_ next: (T) -> Void) -> Subscription {
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
  public func _operator<U>(_ work: (ValueObserver<U>, T) -> Void) -> ValueObservable<U> {
    return ValueObservable<U> { observer in
      return self.subscribe(next: observer: ValueObserver<T> {
        work(observer, $0)
      }).unsubscribe
    }
  }

  public func _map<U>(_ op: OP, _ transform: (T) -> U) -> ValueObservable<U> {
    return _operator(op) { observer, value in
      observer.next(transform(value))
    }
  }

  public func _filter(_ op: OP, _ isIncluded: (T) -> Bool) -> ValueObservable<T> {
    return _operator(op) { observer, value in
      if isIncluded(value) {
        observer.next(value)
      }
    }
  }
}
```

## MVP

### Generic type

There is a single generic value type: `O`. This is the type of observer that can be provided to the
`subscribe` method.

```swift
class IndefiniteObservable<O> {
}
```

### IndefiniteObservable object type

`IndefiniteObservable` is a class with a single generic type, `O`.

```swift
public class IndefiniteObservable<O>
```

### Unsubscribe function type

The function signature expected to be returned by a `Subscriber`.

```swift
public typealias Unsubscribe = () -> Void
```

### Subscriber function type

A `Subscriber` receives an observer and can optionally return an `Unsubscribe` method.

```swift
public typealias Subscriber<O> = (O) -> Unsubscribe?
```

### Subscription object type

A representation of a subscription made by invoking `subscribe` on an `IndefiniteObservable`.

```swift
public protocol Subscription {
  func unsubscribe()
}
```

### IndefiniteObservable initialization

Requires a `Subscriber` type. Store the subscriber as a private constant variable.

```swift
class IndefiniteObservable<O> {
  public init(subscriber: Subscriber<O>) {
    self.subscriber = subscriber
  }

  private let subscriber: Subscriber<O>
```

### Private SimpleSubscription type

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

### IndefiniteObservable.subscribe

Expose a `subscribe` API on `IndefiniteObservable` that accepts an observable and returns a
`Subscription`.

`subscribe` should invoke `self.subscriber` with the provided observer. The returned subscription
is optional and should be wrapped in a `SimpleSubscription` instance before being returned because
`subscribe` must always return a valid Subscription.

```swift
class IndefiniteObservable<T> {
  func subscribe(observer: O) -> Subscription {
    if let subscription = subscriber(observer) {
      return SimpleSubscription(subscription)
    } else {
      return SimpleSubscription()
    }
  }
```
