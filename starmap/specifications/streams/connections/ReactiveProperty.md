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
    label: "streams-android in develop"
    url: https://github.com/material-motion/streams-android
  - platform:
    name: iOS
    label: "streams-swift in develop"
    url: https://github.com/material-motion/streams-swift
---

# ReactiveProperty specification

This is the engineering specification for the `ReactiveProperty` concrete type.

## Overview

`ReactiveProperty` defines an interface for reading, writing, and subscribing to updates of a value.

*Observing changes to a spring's destination reactive property*

```swift
let subscription = spring.destination.addObserver { destination in
  animation.toValue = destination
  animation.isPaused = false
}
```

## MVP

### Option 1: Expose a concrete ScopedReactiveProperty API

```swift
public typealias ScopedRead<T> = () -> T
public typealias ScopedWrite<T> = (T) -> Void

public class ScopedReactiveProperty<T>: ScopedReadable<T>, ScopedWritable<T> {
  private let _read: ScopedRead
  private let _write: ScopedWrite

  public init(read: ScopedRead, write: ScopedWrite) {
    self._read = read
    self._write = write
  }
}
```

### Option 2: Expose a concrete UnscopedReactiveProperty API

```swift
public typealias UnscopedRead = (O) -> T
public typealias UnscopedWrite = (O, T) -> Void

public class UnscopedReactiveProperty<O, T>: UnscopedReadable<O, T>, UnscopedWritable<O, T> {
  public let _read: UnscopedRead
  public let _write: UnscopedWrite

  public init(read: UnscopedRead, write: UnscopedWrite) {
    self._read = read
    self._write = write
  }
}
```

### Expose subscribe APIs

Expose a MotionObserver-shaped subscribe API that accepts a next and state function. Expose a second
subscribe method that only accepts a next function. THe second method should invoke the first with
an empty state function.

```swift
class ReactiveProperty {
  public func subscribe(next: (T) -> Void, state: (MotionState) -> Void) -> Subscription

  public func subscribe(next: (T) -> Void) -> Subscription {
    return self.subscribe(next: next, state: { _ in })
  }
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
  func subscribe(next: (T) -> Void, state: (MotionState) -> Void) -> Subscription {
    let observer = MotionObserver(next: next, state: state)
    observers.append(observer)
```

### Subscribe invokes the observer's next function with the current read value

```swift
class ReactiveProperty {
  func subscribe(next: (T) -> Void, state: (MotionState) -> Void) -> Subscription {
    ...

    observer.next(read())
```

### Subscribe returns a Subscription instance

The unsubscribe implementation should remove the observer from the list of observers.

```swift
class ReactiveProperty {
  func subscribe(next: (T) -> Void, state: (MotionState) -> Void) -> Subscription {
    ...

    return Subscription {
      <remove the observer>
    }
  }
```

### Expose a state API

Informs all subscribed observers of the provided state.

```swift
class ReactiveProperty {
  public func state(state: MotionState) {
    for observer in self.observers {
      observer.state(state)
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
