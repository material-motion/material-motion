---
layout: page
title: thresholdRange
status:
  date: February 21, 2016
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: reactive-motion
depends_on:
  - /starmap/specifications/operators/foundation/$._nextOperator
related_to:
  - /starmap/specifications/operators/threshold
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
      type: ThresholdEvent
---

# thresholdRange specification

This is the engineering specification for the `MotionObservable` operator: `thresholdRange`.

## Overview

`thresholdRange` emits a value based on the incoming value's position around a threshold range.

## Example usage

```swift
stream.thresholdRange(min: 50, max: 100)

upstream min max  |  downstream
20       50  100  |  .whenBelow
50       50  100  |  .whenWithin
100      50  100  |  .whenWithin
120      50  100  |  .whenAbove
```

## MVP

### Expose a thresholdRange operator API

Use `_nextOperator` to implement the operator. Accept a threshold minimum and maximum value.

```swift
class MotionObservable<number> {
  public func thresholdRange(min: T, max: T) -> MotionObservable<ThresholdEvent>
```
