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
public class ScopedReactiveProperty<T>: ScopedReadable<T>, ScopedWritable<T> {
  public typealias Read = () -> T
  public typealias Write = (T) -> Void

  public let read: Read
  public let write: Write

  public init(read: Read, write: Write) {
    self.read = read
    self.write = write
  }
}
```

### Option 2: Expose a concrete UnscopedReactiveProperty API

```swift
public class UnscopedReactiveProperty<O, T>: UnscopedReadable<O, T>, UnscopedWritable<O, T> {
  public typealias Read = (O) -> T
  public typealias Write = (O, T) -> Void

  public let read: Read
  public let write: Write

  public init(read: Read, write: Write) {
    self.read = read
    self.write = write
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

### Expose a next and state API

These methods inform all subscribed observers.

```swift
class ReactiveProperty {
  public func next(_ value: T)
  public func state(_ state: MotionState)
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
    let observer = MotionObserver(next: next, state: state)
    observers.append(observer)
```

### Subscribe invokes the observer's next function with the current read value

```swift
class ReactiveProperty {
  public func addObserver(next: (T) -> Void) -> Subscription {
    ...

    observer.next(read())
```

### Subscribe returns a Subscription instance

The unsubscribe implementation should remove the observer from the list of observers.

```swift
class ReactiveProperty {
  public func addObserver(next: (T) -> Void) -> Subscription {
    ...

    return Subscription {
      <remove the observer>
    }
  }
```

### Next and state should forward to all subscribed observers

```swift
class ReactiveProperty {
  func next(value: T) {
    for observer in observers {
      observer.next(value)
    }
  }

  func state(state: MotionState) {
    for observer in observers {
      observer.state(state)
    }
  }
```
