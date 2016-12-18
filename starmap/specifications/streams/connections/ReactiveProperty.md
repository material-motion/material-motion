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

### Expose a subscribe API

```swift
class ReactiveProperty {
  public func subscribe(_ next: (T) -> Void) -> Subscription
```

### Implement a ReactivePropertyObserver API

This should be a private class. It does not need to conform to a formal Observer type, but it can if
one is available. It should store a constant next function that accepts a value and returns nothing.

```swift
private final class ReactivePropertyObserver<T> {
  let next: (T) -> Void
}
```

### Store the next function as an observer

```swift
class ReactiveProperty {
  public func addObserver(next: (T) -> Void) -> Subscription {
    let observer = ReactivePropertyObserver(next)
    observers.append(observer)
```

### Immediately provide the observer with the current reactive property value

```swift
class ReactiveProperty {
  public func addObserver(next: (T) -> Void) -> Subscription {
    ...

    observer.next(read())
```

### Return a Subscription instance

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

### Inform observers on write

Invoke all observer next functions when the reactive property is written to.

```swift
class ReactiveProperty {
  func write(_ value: T) {
    _write(value)

    for observer in observers {
      observer.next(value)
    }
  }
```
