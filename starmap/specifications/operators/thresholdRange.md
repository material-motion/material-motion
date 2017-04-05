---
layout: page
title: thresholdRange
status:
  date: February 21, 2016
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: material-motion
depends_on:
  - /starmap/specifications/operators/foundation/$._nextOperator
availability:
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/operators/thresholdRange.swift
    tests_url: https://github.com/material-motion/material-motion-swift/blob/develop/tests/unit/operator/thresholdRangeTests.swift
related_to:
  - /starmap/specifications/operators/threshold
  - /starmap/specifications/operators/rewrite
interaction:
  inputs:
    - input:
      name: upstream
      type: number
    - input:
      name: min
      type: number
    - input:
      name: max
      type: number
  outputs:
    - output:
      name: downstream
      type: ThresholdSide
---

# thresholdRange specification

This is the engineering specification for the `MotionObservable` operator: `thresholdRange`.

## Overview

`thresholdRange` emits a value based on the incoming value's position around a threshold range.

## Example usage

```swift
stream.thresholdRange(min: 50, max: 100)

upstream min max  |  downstream
20       50  100  |  .below
50       50  100  |  .within
100      50  100  |  .within
120      50  100  |  .above
```

## MVP

### Expose a thresholdRange operator API

Use `_nextOperator` to implement the operator. Accept a threshold minimum and maximum value.

```swift
class MotionObservable<number> {
  public func thresholdRange(min: number, max: number) -> MotionObservable<ThresholdSide>
```
