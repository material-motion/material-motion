---
layout: page
title: MotionObservable
status:
  date: December 7, 2016
  is: Stable
knowledgelevel: L4
library: streams
depends_on:
  - /starmap/specifications/streams/IndefiniteObservable/
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

# MotionObservable specification

This is the engineering specification for the `MotionObservable` object.

## Overview

`MotionObservable` is a specialization of [`IndefiniteObservable`](IndefiniteObservable).
`MotionObservable` includes two channels: `next` and `state`.

## MVP

### Expose a State enumeration

Should include two possible states: `atRest` and `active`. If you must give the states numerical
values then make `atRest = 0` and `active = 1`.

```swift
public enum MotionState {
  case atRest
  case active
}
```

### Expose a MotionObserver API

Provide a class for creating a motion observer using inline functions.

```swift
public final class MotionObserver<T> {
  public typealias Value = T

  public init(_ next: (T) -> Void, state: (MotionState) -> Void) {
    self.next = next
    self.state = state
  }

  public let next: (T) -> Void
  public let state: (MotionState) -> Void
}
```

### Subclass IndefiniteObservable

```swift
public class MotionObservable<T>: IndefiniteObservable<MotionObserver<T>> {
}
```

### Expose a helper subscribe API

This API should allow a client to subscribe to a `MotionObservable` without having to create a
`MotionObserver`.

```swift
class MotionObservable<V>: IndefiniteObservable<MotionObserver<V>> {
  public func subscribe(next: (T) -> Void, state: (MotionState) -> Void) -> Subscription {
    return super.subscribe(observer: MotionObserver<T>(next: next, state: state))
  }
}
```

### Expose a helper no-op subscribe API

This API should allow a client to subscribe to a `MotionObservable` without having to provide any
arguments. All `next` and `state` events will be ignored.

```swift
class MotionObservable<V>: IndefiniteObservable<MotionObserver<V>> {
  public func subscribe() -> Subscription {
    return super.subscribe(observer: MotionObserver<T>(next: { }, state: { }))
  }
}
```
