---
layout: page
title: lowerBound
status:
  date: February 20, 2016
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: material-motion
depends_on:
  - /starmap/specifications/operators/foundation/$._map
related_to:
  - /starmap/specifications/operators/upperBound
proposals:
  - proposal:
    completion_date: February 20, 2017
    state: Stable
    discussion: "Renamed from min to lowerBound"
availability:
  - platform:
    name: Android
    url: https://github.com/material-motion/material-motion-android/blob/develop/library/src/main/java/com/google/android/material/motion/operators/LowerBound.java
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/operators/lowerBound.swift
    tests_url: https://github.com/material-motion/material-motion-swift/blob/develop/tests/unit/operator/lowerBoundTests.swift
interaction:
  inputs:
    - input:
      name: upstream
      type: Comparable
    - input:
      name: minValue
      type: Comparable
  outputs:
    - output:
      name: downstream
      type: Comparable
---

# lowerBound specification

This is the engineering specification for the `MotionObservable` operator: `lowerBound`.

## Overview

`lowerBound` emits either the incoming value or the provided `minValue`, whichever is larger.

## Example usage

```swift
stream.lowerBound(minValue: 0)

upstream  minValue  |  downstream
 0.50     0         |  0.50
 0.25     0         |  0.25
 0.00     0         |  0.00
-0.25     0         |  0.00
-0.50     0         |  0.00
```

## MVP

### Expose a lowerBound operator API

Use `_map` to implement the operator. Accept a Comparable type. Emit the result of
`max(upstreamValue, minValue)`.

```swift
class MotionObservable<Comparable> {
  public func lowerBound(minValue: Comparable) -> MotionObservable<Comparable>
```
