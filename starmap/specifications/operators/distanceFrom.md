---
layout: page
title: distanceFrom
status:
  date: February 20, 2016
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: material-motion
depends_on:
  - /starmap/specifications/operators/foundation/$._map
availability:
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/operators/distanceFrom.swift
    tests_url: https://github.com/material-motion/material-motion-swift/blob/develop/tests/unit/operator/distanceFromTests.swift
interaction:
  inputs:
    - input:
      name: upstream
      type: "T: &lt;number | Point>"
    - input:
      name: location
      type: "T: &lt;number | Point>"
  outputs:
    - output:
      name: downstream
      type: number
---

# distanceFrom specification

This is the engineering specification for the `MotionObservable` operator: `distanceFrom`.

## Overview

`distanceFrom` emits the absolute distance from the upstream value and the provided `location`.

## Example usage

```swift
stream.distanceFrom(location: 50)

upstream  location  |  downstream
20        50        |  30
40        50        |  10
80        50        |  30
```

## MVP

### Expose a 1-dimensional distanceFrom operator API

Use `_map` to implement the operator. Accept a location number. Emit a number which is the
result of `abs(upstreamValue - location)`.

```swift
class MotionObservable<number> {
  public func distance(from location: number) -> MotionObservable<number>
```

### Expose a 2-dimensional distanceFrom operator API

Use `_map` to implement the operator. Accept a location point. Emit a number which is the
result of `sqrt((upstreamValue.x - location.x)^2 - (upstreamValue.y - location.y)^2)`.

```swift
class MotionObservable<Point2D> {
  public func distance(from location: Point2D) -> MotionObservable<number>
```
