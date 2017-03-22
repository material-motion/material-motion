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
      type: ThresholdEvent
---

# threshold specification

This is the engineering specification for the `MotionObservable` operator: `threshold`.

## Overview

`threshold` emits a ThresholdEvent based on the incoming value's position around a threshold.

## Example usage

```swift
stream.threshold(50)

upstream position  |  downstream
20       50        |  .whenBelow
50       50        |  .whenWithin
60       50        |  .whenAbove
```

## MVP

### Expose a ThresholdEvent enum type

```swift
public enum ThresholdEvent {
  case whenBelow
  case whenWithin
  case whenAbove
}
```

### Expose a threshold operator API

Use `_nextOperator` to implement the operator. Accept a single position value.

```swift
class MotionObservable<number> {
  public func threshold<U>(_ threshold: number) -> MotionObservable<ThresholdEvent>
```
