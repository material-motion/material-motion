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

## MVP

### Generic type

There is a single generic value type: `T`. This is the type of value that can be received from an
IndefiniteObservable.

### IndefiniteObservable object type

`IndefiniteObservable` is a class with a single generic type, `T`.

```swift
public final class IndefiniteObservable<T>
```

### Observer object type

`Observer` is a protocol with a `next` method that accepts a `T` value.

```swift
public protocol Observer<T> {
  readonly var next: (T) -> Void
}
```

### Unsubscribe function type

The function signature expected to be returned by a `Subscriber`.

```swift
public typealias Unsubscribe = () -> Void
```

### Subscriber function type

A `Subscriber` receives an `Observer` and can optionally return an `Unsubscribe` method.

```swift
public typealias Subscriber<T> = (Observer<T>) -> Unsubscribe?
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
class IndefiniteObservable<T> {
  init(subscriber: Subscriber<T>) {
    self.subscriber = subscriber
  }

  private let subscriber: Subscriber<T>
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

### AnyObserver type

Provide an `AnyObserver` class that conforms to `Observer`. It must be initialized with a next
function.

```swift
public final class AnyObserver<T>: Observer {
  public typealias Value = T

  public init(_ next: @escaping (T) -> Void) {
    self.next = next
  }

  public let next: (T) -> Void
}
```

### IndefiniteObservable.subscribe

Expose a `subscribe` API on `IndefiniteObservable` that accepts a `next` function and returns a
`Subscription`.

`subscribe` should invoke `self.subscriber` with the provided observer. The returned subscription
is optional and should be wrapped in a `SimpleSubscription` instance before being returned because
`subscribe` must always return a valid Subscription.

```swift
class IndefiniteObservable<T> {
  func subscribe(next: (T) -> Void) -> Subscription {
    let observer = AnyObserver<T>(next)
    if let subscription = self.subscriber(observer) {
      return SimpleSubscription(subscription)
    } else {
      return SimpleSubscription()
    }
  }
```
