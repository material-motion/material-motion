---
layout: page
title: rubberBanded
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
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/operators/rubberBanded.swift
    tests_url: https://github.com/material-motion/material-motion-swift/blob/develop/tests/unit/operator/rubberBandedTests.swift
interaction:
  inputs:
    - input:
      name: upstream
      type: number
  outputs:
    - output:
      name: downstream
      type: number
---

# rubberBanded specification

This is the engineering specification for the `MotionObservable` operator: `rubberBanded`.

## Overview

`rubberBanded` applies resistance to values that fall outside of the given range and emits the
result.

## MVP

### Expose a rubberBanded operator API

Use `_map` to implement the operator. Accept a number value. Emit the result of `incoming + value`.

```swift
class MotionObservable<number> {
  public func rubberBanded(below: number, above: number, length: number) -> MotionObservable<number>
}
```

### Implement the rubber-banding math

```swift
public func rubberBand(value: number, min: number, max: number, bandLength: number) -> number {
  if value >= min && value <= max {
    // While we're within range we don't rubber band the value.
    return value
  }

  if bandLength <= 0 {
    // The rubber band doesn't exist, return the minimum value so that we stay put.
    return min
  }

  // 0.55 chosen as an approximation of iOS' rubber banding behavior.
  let rubberBandCoefficient: number = 0.55
  // Accepts values from [0...+inf and ensures that f(x) < bandLength for all values.
  let band: (number) -> number = { value in
    let demoninator = value * rubberBandCoefficient / bandLength + 1
    return bandLength * (1 - 1 / demoninator)
  }
  if (value > max) {
    return band(value - max) + max

  } else if (value < min) {
    return min - band(min - value)
  }

  return value
}
```

### Apply the rubber band math

```swift
class MotionObservable<number> {
  func rubberBanded(below: number, above: number, length: number) -> MotionObservable<number> {
    return _map {
      return rubberBand(value: $0, min: below, max: above, bandLength: length)
    }
  }
}
```
