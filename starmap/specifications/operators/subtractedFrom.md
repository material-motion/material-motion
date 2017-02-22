---
layout: page
title: subtractedFrom
status:
  date: February 21, 2016
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: reactive-motion
depends_on:
  - /starmap/specifications/operators/foundation/_map
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

# subtractedFrom specification

This is the engineering specification for the `MotionObservable` operator: `subtractedFrom`.

## Overview

`subtractedFrom` emits the result of subtracting the incoming value from a given value.

Example usage:

```swift
stream.subtracted(from: 1)

upstream  value  downstream
0.2       1      0.8
0.5       1      0.5
1.2       1      -0.2
```

## MVP

### Expose a subtractedFrom API

Use `_map` to implement the operator. Accept a number value. Emit the result of `value - incoming`.

```swift
class MotionObservable {
  public func subtracted(from value: number) -> MotionObservable<number>
```
