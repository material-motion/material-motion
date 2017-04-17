---
layout: page
title: slop
status:
  date: February 21, 2016
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: material-motion
depends_on:
  - /starmap/specifications/observable/MotionObservable
  - /starmap/specifications/operators/dedupe
  - /starmap/specifications/operators/rewrite
  - /starmap/specifications/operators/thresholdRange
  - /starmap/specifications/operators/ignoreUntil
availability:
  - platform:
    name: Android
    url: https://github.com/material-motion/material-motion-android/blob/develop/library/src/main/java/com/google/android/material/motion/operators/Slop.java
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/operators/slop.swift
    tests_url: https://github.com/material-motion/material-motion-swift/blob/develop/tests/unit/operator/slopTests.swift
interaction:
  inputs:
    - input:
      name: upstream
      type: number
    - input:
      name: size
      type: number
  outputs:
    - output:
      name: downstream
      type: SlopEvent
---

# slop specification

This is the engineering specification for the `MotionObservable` operator: `slop`.

## Overview

`slop` emits events in reaction to exiting and re-entering a slop region.

The slop region is centered around 0 and has a given size. This operator will not emit any
events until the upstream value exits this slop region, at which point `onExit` will be emitted. If
the upstream returns to the slop region then `onReturn` will be emitted.

## Example usage

```swift
stream.slop(size: 50)

upstream size  |  downstream
20       50    |
10       50    |
60       50    |  .onExit
70       50    |
10       50    |  .onReturn
20       50    |
80       50    |  .onExit
```

## MVP

### Expose a SlopEvent type

```swift
public enum SlopEvent {
  case onExit
  case onReturn
}
```

### Expose a slop operator API

Accept a single argument defining the size of the slop region, centered around 0.

```swift
class MotionObservable<number> {
  public func slop(size: number) -> MotionObservable<SlopEvent>
```

### Calculate and emit the new slop event

```swift
class MotionObservable<number> {
  func slop(size: number) -> MotionObservable<SlopEvent> {
    return self
      .thresholdRange(min: -size, max: size)
      .rewrite([.whenBelow: .onExit, .whenWithin: .onReturn, .whenAbove: .onExit])
      .dedupe()
      .ignoreUntil(.onExit)
```
