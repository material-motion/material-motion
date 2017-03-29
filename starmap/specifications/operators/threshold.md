---
layout: page
title: threshold
status:
  date: February 21, 2017
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: material-motion
depends_on:
  - /starmap/specifications/operators/foundation/$._nextOperator
proposals:
  - proposal:
    completion_date: March 22, 2017
    state: Stable
    discussion: "ThresholdEvent renamed to ThresholdSide. Dropped when- prefix."
related_to:
  - /starmap/specifications/operators/thresholdRange
  - /starmap/specifications/operators/rewrite
interaction:
  inputs:
    - input:
      name: upstream
      type: number
    - input:
      name: threshold
      type: number
  outputs:
    - output:
      name: downstream
      type: ThresholdSide
---

# threshold specification

This is the engineering specification for the `MotionObservable` operator: `threshold`.

## Overview

`threshold` emits a ThresholdEvent based on the incoming value's position around a threshold.

## Example usage

```swift
stream.threshold(50)

upstream position  |  downstream
20       50        |  .below
50       50        |  .within
60       50        |  .above
```

## MVP

### Expose a ThresholdSide enum type

```swift
public enum ThresholdSide {
  case below
  case within
  case above
}
```

### Expose a threshold operator API

Use `_nextOperator` to implement the operator. Accept a single position value.

```swift
class MotionObservable<number> {
  public func threshold<U>(_ threshold: number) -> MotionObservable<ThresholdSide>
```
