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

### Expose a MotionObserver API

Provide a class for creating a motion observer using inline functions.

```swift
public final class MotionObserver<V> {
  public typealias Value = V

  public init(_ next: (V) -> Void, state: (MotionState) -> Void) {
    self.next = next
    self.state = state
  }

  public let next: (V) -> Void
  public let state: (MotionState) -> Void
}
```

### Subclass IndefiniteObservable

```swift
public class MotionObservable<V>: IndefiniteObservable<MotionObserver<V>> {
}
```
