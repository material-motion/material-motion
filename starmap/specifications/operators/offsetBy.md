---
layout: page
title: offsetBy
status:
  date: February 21, 2016
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: reactive-motion
depends_on:
  - /starmap/specifications/operators/foundation/$._map
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

# offsetBy specification

This is the engineering specification for the `MotionObservable` operator: `offsetBy`.

## Overview

`offsetBy` emits the result of adding the incoming value to a given value.

Example usage:

```swift
stream.offset(by: -50)

upstream  value  |  downstream
20        -50    |  -30
40        -50    |  -10
80        -50    |   30
```

## MVP

### Expose an offsetBy operator API

Use `_map` to implement the operator. Accept a number value. Emit the result of `incoming + value`.

```swift
class MotionObservable {
  public func offset(by value: number) -> MotionObservable<number>
```
