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
    - input:
      name: whenBelow
      type: U?
    - input:
      name: whenWithin
      type: U?
    - input:
      name: whenAbove
      type: U?
  outputs:
    - output:
      name: downstream
      type: U
---

# thresholdRange specification

This is the engineering specification for the `MotionObservable` operator: `thresholdRange`.

## Overview

`thresholdRange` emits a value based on the incoming value's position around a threshold range.

## Example usage

```swift
stream.thresholdRange(min: 50, max: 100, whenBelow: .below, whenEqual: nil, whenAbove: .above)

upstream min max whenBelow whenEqual whenAbove  |  downstream
20       50  100 .below    nil       .above     |  .below
50       50  100 .below    nil       .above     |
100      50  100 .below    nil       .above     |
120      50  100 .below    nil       .above     |  .above
```

## MVP

### Expose a thresholdRange operator API

Use `_nextOperator` to implement the operator. Accept five arguments:

1. a threshold min,
1. a threshold max,
2. an optional value to emit when upstream is **below** the thresholdRange,
3. an optional value to emit when upstream is **within** the thresholdRange, and
4. an optional value to emit when upstream is **above** the thresholdRange.

```swift
class MotionObservable<number> {
  public func thresholdRange<U>
      ( min: T,
        max: T,
        whenBelow below: U?,
        whenWithin within: U?,
        whenAbove above: U?
      ) -> MotionObservable<U>
```
