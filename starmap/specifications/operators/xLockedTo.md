---
layout: page
title: xLockedTo
status:
  date: March 30, 2016
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: material-motion
depends_on:
  - /starmap/specifications/operators/foundation/$._map
proposals:
  - proposal:
    completion_date: March 30, 2017
    state: Stable
    discussion: "First introduced"
availability:
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/operators/xLockedTo.swift
    tests_url: https://github.com/material-motion/material-motion-swift/blob/develop/tests/unit/operator/xLockedToTests.swift
interaction:
  inputs:
    - input:
      name: upstream
      type: Point
    - input:
      name: xValue
      type: number
  outputs:
    - output:
      name: downstream
      type: Point
---

# xLockedTo specification

This is the engineering specification for the `MotionObservable` operator: `xLockedTo`.

## Overview

`xLockedTo` sets the upstream point's x value to the provided value and emits the result.

## Example usage

```swift
stream.xLocked(to: 50)

upstream  xValue  |  downstream
20, 50    50      |  50, 50
40, 80    50      |  50, 80
60, 90    50      |  50, 90
```

## MVP

### Expose an xLockedTo operator API

Use `_map` to implement the operator. Accept an xValue number. Emit `{xValue, upstream.y}`.

```swift
class MotionObservable<number> {
  public func xLocked(to xValue: number) -> MotionObservable<Point>
}
```
