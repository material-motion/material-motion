---
layout: page
title: upperBound
status:
  date: February 20, 2016
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: material-motion
depends_on:
  - /starmap/specifications/operators/foundation/$._map
related_to:
  - /starmap/specifications/operators/lowerBound
proposals:
  - proposal:
    completion_date: February 20, 2017
    state: Stable
    discussion: "Renamed from max to upperBound"
availability:
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/operators/upperBound.swift
    tests_url: https://github.com/material-motion/material-motion-swift/blob/develop/tests/unit/operator/upperBoundTests.swift
interaction:
  inputs:
    - input:
      name: upstream
      type: Comparable
    - input:
      name: maxValue
      type: Comparable
  outputs:
    - output:
      name: downstream
      type: Comparable
---

# upperBound specification

This is the engineering specification for the `MotionObservable` operator: `upperBound`.

## Overview

`upperBound` emits either the incoming value or the provided `maxValue`, whichever is smaller.

## Example usage

```swift
stream.upperBound(maxValue: 1)

upstream  maxValue  |  downstream
0.50      1         |  0.50
0.75      1         |  0.75
1.00      1         |  1.00
1.25      1         |  1.00
1.50      1         |  1.00
```

## MVP

### Expose a upperBound operator API

Use `_map` to implement the operator. Accept a Comparable type. Emit the result of
`min(upstreamValue, maxValue)`.

```swift
class MotionObservable<Comparable> {
  public func upperBound(maxValue: Comparable) -> MotionObservable<Comparable>
```
