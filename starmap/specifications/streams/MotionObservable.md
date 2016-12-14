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
    tests_url: https://github.com/material-motion/streams-android/blob/develop/library/src/test/java/com/google/android/material/motion/streams/MotionObservableTests.java
  - platform:
    name: JavaScript
    url: https://github.com/material-motion/material-motion-js/blob/develop/packages/streams/src/MotionObservable.ts
    tests_url: https://github.com/material-motion/material-motion-js/blob/develop/packages/streams/src/__tests__/MotionObservable.test.ts
  - platform:
    name: Swift
    url: https://github.com/material-motion/streams-swift/blob/develop/src/MotionObservable.swift
    tests_url: https://github.com/material-motion/streams-swift/blob/develop/tests/unit/MotionObservableTests.swift
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
