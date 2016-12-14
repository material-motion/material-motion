---
layout: page
permalink: /starmap/specifications/streams/IndefiniteObservable/
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
    tests_url: https://github.com/material-motion/indefinite-observable-android/blob/develop/library/src/test/java/com/google/android/material/motion/observable/IndefiniteObservableTests.java
  - platform:
    name: iOS
    url: https://github.com/material-motion/indefinite-observable-swift/blob/develop/src/IndefiniteObservable.swift
    tests_url: https://github.com/material-motion/indefinite-observable-swift/tree/develop/tests/unit
  - platform:
    name: JavaScript
    label: "indefinite-observable-js as of v1.0.0"
    url: https://github.com/material-motion/indefinite-observable-js
    tests_url: https://github.com/material-motion/indefinite-observable-js/blob/develop/src/__tests__/IndefiniteObservable.test.ts
---

# IndefiniteObservable specification

This is the engineering specification for the `IndefiniteObservable` object.

## Overview

IndefiniteObservable is a minimal implementation of [Observable](http://reactivex.io/rxjs/manual/overview.html)
with no concept of completion or failure.

## Examples

```swift
public final class ValueObserver<T>: Observer<T> {
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
  return noopDisconnect
}

let _ = observable.subscribe { value in
  print(value)
}

// Example operators:
extension ValueObservable {
  public func _operator<U>(_ operation: (ValueObserver<U>, T) -> Void) -> ValueObservable<U> {
    return ValueObservable<U> { observer in
      return self.subscribe(next: observer: ValueObserver<T> {
        operation(observer, $0)
      }).unsubscribe
    }
  }

  public func _map<W>(transform: (T) -> U) -> ValueObservable<W> {
    return _operator(op) { observer, value in
      observer.next(transform(value))
    }
  }

  public func _filter(predicate: (T) -> Bool) -> ValueObservable<T> {
    return _operator(op) { observer, value in
      if predicate(value) {
        observer.next(value)
      }
    }
  }
}
```

## MVP

### Expose a generic abstract Observer type

Define the base Observer type which has a single **channel** called `next`. `next` accepts an
argument of type `T`.

```swift
public protocol Observer<T> {
  func next(value: T)
}
```

### Expose a concrete IndefiniteObservable type

There is a single generic value type: `O`. This is the type of observer that can be provided to the
`subscribe` method. This type should conform to the abstract `Observer` type.

```swift
class IndefiniteObservable<O: Observer> {
}
```

### Expose a Connect function type

`Connect` receives an `observer` and returns a `Disconnect` function.

```swift
public typealias Connect<O> = (O) -> Disconnect
```

### Expose a noopDisconnect constant

This value can be returned by a connect function to indicate that no disconnection work will occur.

```swift
public let noopDisconnect: Disconnect = { }
```

### Expose a Disconnect function type

The function signature expected to be returned by a `Connect`.

```swift
public typealias Disconnect = () -> Void
```

### Expose an Unsubscribe function type

`Unsubscribe` should have the same shape as `Disconnect`.

```swift
public typealias Unsubscribe = () -> Void
```

### Expose a Subscription object type

A representation of a subscription made by invoking `subscribe` on an `IndefiniteObservable`.

```swift
public final class Subscription {
  deinit {
    unsubscribe()
  }

  init(_ disconnect: () -> Void) {
    self.disconnect = disconnect
  }

  public func unsubscribe() {
    if disconnect != nil {
      disconnect()
      disconnect = nil
    }
  }

  private var disconnect: (Disconnect)?
}
```

This class should store a `disconnect` function. The first time `unsubscribe` is called, it should call the `disconnect` function. Thereafter, it should do nothing.  `disconnect` shouldn't be called more than once per connection.

When the `Subscription` is deallocated it should invoke `unsubscribe`.

### Expose an IndefiniteObservable initializer

Requires a `Connect` type. Store `connect` as a private constant.

```swift
class IndefiniteObservable<O> {
  public init(connect: Connect<O>) {
    _connect = connect
  }

  private let _connect: Connect<O>
```

### Expose a subscribe API on IndefiniteObservable

Expose a `subscribe` API on `IndefiniteObservable` that accepts an `observer` and returns a
`Subscription`.

`subscribe` should invoke `self._connect` with the provided observer.

```swift
class IndefiniteObservable<O> {
  func subscribe(observer: O) -> Subscription {
    return _connect(observer);
  }
}
```
