---
layout: page
title: MotionObservable
status:
  date: December 4, 2016
  is: Draft
knowledgelevel: L4
library: streams
depends_on:
  - /starmap/specifications/streams/IndefiniteObservable
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

### Expose MotionObserver API

```
public protocol MotionObserver {
  associatedtype Value

  var next: (Value) -> Void { get }
  var state: (MotionState) -> Void { get }
}
```

### Subclass IndefiniteObservable

```
public class ValueObservable<T>: IndefiniteObservable<ValueObserver<T>> {
}
```

### Expose an AnyMotionObserver API

Provide an API for creating a motion observer using inline functions.

```swift
public final class AnyMotionObserver<T>: MotionObserver {
  public typealias Value = T

  public init(_ next: (T) -> Void, state: (MotionState) -> Void) {
    self.next = next
    self.state = state
  }

  public let next: (T) -> Void
  public let state: (MotionState) -> Void
}
```
