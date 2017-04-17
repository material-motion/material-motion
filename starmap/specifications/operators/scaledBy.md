---
layout: page
title: scaledBy
status:
  date: February 21, 2016
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: material-motion
depends_on:
  - /starmap/specifications/operators/foundation/$._map
availability:
  - platform:
    name: Android
    url: https://github.com/material-motion/material-motion-android/blob/develop/library/src/main/java/com/google/android/material/motion/operators/ScaledBy.java
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/operators/scaledBy.swift
    tests_url: https://github.com/material-motion/material-motion-swift/blob/develop/tests/unit/operator/scaledByTests.swift
interaction:
  inputs:
    - input:
      name: upstream
      type: number
  outputs:
    - output:
      name: downstream
      type: number
---

# scaledBy specification

This is the engineering specification for the `MotionObservable` operator: `scaledBy`.

## Overview

`scaledBy` emits the result of multiplying the incoming value by a given value.

Example usage:

```swift
stream.scaled(by: 2)

upstream  value  |  downstream
20        2      |  40
40        2      |  80
80        2      |  160
```

## MVP

### Expose a scaledBy operator API

Use `_map` to implement the operator. Accept a number value. Emit the result of `incoming * value`.

```swift
class MotionObservable {
  public func scaled(by value: number) -> MotionObservable<number>
```
