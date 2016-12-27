---
layout: page
title: ReactiveProperty
status:
  date: December 6, 2016
  is: Draft
knowledgelevel: L2
library: streams
depends_on:
  - /starmap/specifications/streams/connections/Readable
  - /starmap/specifications/streams/connections/Writable
availability:
  - platform:
    name: Android
    url: https://github.com/material-motion/streams-android
  - platform:
    name: Swift
    url: https://github.com/material-motion/streams-swift/blob/develop/src/ReactiveProperty.swift
---

# ReactiveProperty specification

This is the engineering specification for the `ReactiveProperty` concrete type.

## Overview

`ReactiveProperty` defines an interface for reading, writing, and subscribing to updates of a value.

*Observing changes to a spring's destination reactive property*

```swift
const var subscription = spring.destination.subscribe { destination in
  animation.toValue = destination
  animation.isPaused = false
}
```

## MVP

### Expose a concrete ReactiveProperty API

```swift
public typealias ScopedRead<T> = () -> T
public typealias ScopedWrite<T> = (T) -> Void

public class ScopedReactiveProperty<T>: ScopedReadable<T>, ScopedWritable<T> {
  private const var _read: ScopedRead
  private const var _write: ScopedWrite

  public init(read: ScopedRead, write: ScopedWrite) {
    self._read = read
    self._write = write
  }
}
```

### Expose subscribe APIs

Expose a MotionObserver-shaped subscribe API that accepts a next function.

```swift
class ReactiveProperty {
  public func subscribe(next: (T) -> Void) -> Subscription
```

### Expose a read API

Should invoke the provided read function.

```swift
class ReactiveProperty {
  public func read() -> T {
    return self._read()
  }
```

### Store a list of MotionObserver instances

```swift
class ReactiveProperty {
  private var observers: [MotionObserver<T>] = []
```

### Subscribe adds an observer to a list of observers

```swift
class ReactiveProperty {
  func subscribe(next: (T) -> Void) -> Subscription {
    const var observer = MotionObserver(next: next)
    observers.append(observer)
```

### Subscribe invokes the observer's next function with the current read value

```swift
class ReactiveProperty {
  func subscribe(next: (T) -> Void) -> Subscription {
    ...

    observer.next(read())
```

### Subscribe returns a Subscription instance

The unsubscribe implementation should remove the observer from the list of observers.

```swift
class ReactiveProperty {
  func subscribe(next: (T) -> Void) -> Subscription {
    ...

    return Subscription {
      <remove the observer>
    }
  }
```

### Expose a write API

Invokes the provided write function and informs all subscribed observers of the new value.

```swift
class ReactiveProperty {
  public func write(_ value: T) {
    self._write(value)

    for observer in self.observers {
      observer.next(value)
    }
  }
```
