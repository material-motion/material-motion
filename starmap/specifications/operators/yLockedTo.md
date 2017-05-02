---
layout: page
title: yLockedTo
status:
  date: March 30, 2016
  is: Proposed
interfacelevel: L2
implementationlevel: L3
library: material-motion
depends_on:
  - /starmap/specifications/operators/foundation/$._map
proposals:
  - proposal:
    completion_date: March 30, 2017
    state: Stable
    discussion: "First proposed"
availability:
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/operators/yLockedTo.swift
    tests_url: https://github.com/material-motion/material-motion-swift/blob/develop/tests/unit/operator/yLockedToTests.swift
interaction:
  inputs:
    - input:
      name: upstream
      type: Point
    - input:
      name: yValue
      type: number
  outputs:
    - output:
      name: downstream
      type: Point
---

# yLockedTo specification

This is the engineering specification for the `MotionObservable` operator: `yLockedTo`.

## Overview

`yLockedTo` sets the upstream point's y value to the provided value and emits the result.

## Example usage

```swift
stream.yLocked(to: 50)

upstream  yValue  |  downstream
20, 50    50      |  20, 50
40, 80    50      |  40, 50
60, 90    50      |  60, 50
```

## MVP

### Expose an yLockedTo operator API

Use `_map` to implement the operator. Accept an yValue number. Emit `{upstream.x, yValue}`.

```swift
class MotionObservable<number> {
  public func yLocked(to yValue: number) -> MotionObservable<Point>
}
```
