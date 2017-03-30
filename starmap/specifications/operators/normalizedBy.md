---
layout: page
title: normalizedBy
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
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/operators/normalizedBy.swift
    tests_url: https://github.com/material-motion/material-motion-swift/blob/develop/tests/unit/operator/normalizedByTests.swift
interaction:
  inputs:
    - input:
      name: upstream
      type: number | Point2D
    - input:
      name: amount
      type: number | Point2D
  outputs:
    - output:
      name: downstream
      type: number | Point2D
---

# normalizedBy specification

This is the engineering specification for the `MotionObservable` operator: `normalizedBy`.

## Overview

`normalizedBy` emits the result of dividing the incoming scalar values by a given amount.

Example usage:

```swift
stream.normalized(by: 50)

upstream  amount  |  downstream
20        50      |  0.4
40        50      |  0.8
80        50      |  1.6
```

```swift
stream.normalized(by: CGPoint(x: 100, y: 10))

upstream  amount   |  downstream
10, 20    100, 10  |  0.1, 2
50, 2     100, 10  |  0.5, 0.2
20, -5    100, 10  |  0.2, -0.5
```

## MVP

### Expose a scalar normalizedBy operator API

Use `_map` to implement the operator. Accept a number value. Emit the result of `incoming / value`.

```swift
class MotionObservable {
  public func normalized(by value: number) -> MotionObservable<number>
}
```

### Expose a point normalizedBy operator API

Use `_map` to implement the operator. Accept a point value. Emit the result of
`incoming.x / value.x`, `incoming.y / value.y`.

```swift
class MotionObservable {
  public func normalized(by value: Point2D) -> MotionObservable<Point2D>
}
```
