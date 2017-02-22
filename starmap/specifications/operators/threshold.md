---
layout: page
title: threshold
status:
  date: February 21, 2016
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: reactive-motion
depends_on:
  - /starmap/specifications/operators/foundation/$._nextOperator
related_to:
  - /starmap/specifications/operators/thresholdRange
interaction:
  inputs:
    - input:
      name: upstream
      type: number
    - input:
      name: threshold
      type: number
    - input:
      name: whenBelow
      type: U?
    - input:
      name: whenEqual
      type: U?
    - input:
      name: whenAbove
      type: U?
  outputs:
    - output:
      name: downstream
      type: U
---

# threshold specification

This is the engineering specification for the `MotionObservable` operator: `threshold`.

## Overview

`threshold` emits a value based on the incoming value's position around a threshold.

## Example usage

```swift
stream.threshold(50, whenBelow: .below, whenEqual: nil, whenAbove: .above)

upstream threshold whenBelow whenEqual whenAbove  |  downstream
20       50        .below    nil       .above     |  .below
50       50        .below    nil       .above     |  
60       50        .below    nil       .above     |  .above
```

## MVP

### Expose a threshold operator API

Use `_nextOperator` to implement the operator. Accept four arguments:

1. a threshold,
2. an optional value to emit when upstream is **below** the threshold,
3. an optional value to emit when upstream is **equal to** the threshold, and
4. an optional value to emit when upstream is **above** the threshold.

```swift
class MotionObservable<number> {
  public func threshold<U>
      ( _ threshold: number,
        whenBelow below: U?,
        whenEqual equal: U?,
        whenAbove above: U?
      ) -> MotionObservable<U>
```
