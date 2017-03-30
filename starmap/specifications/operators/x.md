---
layout: page
title: x
status:
  date: February 21, 2016
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: material-motion
depends_on:
  - /starmap/specifications/operators/foundation/$._map
availability:
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/operators/x.swift
    tests_url: https://github.com/material-motion/material-motion-swift/blob/develop/tests/unit/operator/xTests.swift
related_to:
  - /starmap/specifications/operators/y
interaction:
  inputs:
    - input:
      name: upstream
      type: Point
  outputs:
    - output:
      name: downstream
      type: number
---

# x specification

This is the engineering specification for the `MotionObservable` operator: `x`.

## Overview

`x` extracts the x value from a Point stream.

Example usage:

```swift
stream.x()

upstream        |  downstream
{x: 20, y: 25}  |  20
{x: 40, y: 10}  |  40
{x: 70, y: 30}  |  70
```

## MVP

### Expose an x operator API

Use `_map` to implement the operator. Return the x value. Exposed on streams of type Point.

```swift
class MotionObservable<Point> {

  public func x() -> MotionObservable<Float> { return _map { return $0.x } }
```
