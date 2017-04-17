---
layout: page
title: MotionObservable
status:
  date: December 7, 2016
  is: Stable
interfacelevel: L3
implementationlevel: L4
library: material-motion
depends_on:
  - /starmap/specifications/observable/IndefiniteObservable
proposals:
  - proposal:
    completion_date: December 7, 2017
    state: Stable
    discussion: "Stabilized the MotionObservable API"
  - proposal:
    initiation_date: February 13, 2017
    completion_date: February 17, 2017
    state: Stable
    discussion: "Removed the state channel"
availability:
  - platform:
    name: Android
    url: https://github.com/material-motion/material-motion-android/blob/develop/library/src/main/java/com/google/android/material/motion/MotionObservable.java
    tests_url: https://github.com/material-motion/material-motion-android/blob/develop/library/src/test/java/com/google/android/material/motion/MotionObservableTests.java
  - platform:
    name: JavaScript
    url: https://github.com/material-motion/material-motion-js/blob/develop/packages/streams/src/observables/MotionObservable.ts
    tests_url: https://github.com/material-motion/material-motion-js/blob/develop/packages/streams/src/observables/__tests__/motionObservable.test.ts
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/reactivetypes/MotionObservable.swift
    tests_url: https://github.com/material-motion/material-motion-swift/blob/develop/tests/unit/MotionObservableTests.swift
---

# MotionObservable specification

This is the engineering specification for the `MotionObservable` object.

## Overview

`MotionObservable` is a specialization of [`IndefiniteObservable`](IndefiniteObservable).

The purpose of this specialization is to provide a canonical scope for building motion-related
operators.

## MVP

### Expose a MotionObserver API

Provide a class for creating a motion observer using inline functions.

```swift
public final class MotionObserver<T> {
  public typealias Value = T

  public init(_ next: (T) -> Void) {
    self.next = next
  }

  public let next: (T) -> Void
}
```

### Subclass IndefiniteObservable

```swift
public class MotionObservable<T>: IndefiniteObservable<MotionObserver<T>> {
}
```
