---
layout: page
title: normalizedBy
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

# normalizedBy specification

This is the engineering specification for the `MotionObservable` operator: `normalizedBy`.

## Overview

`normalizedBy` emits the result of dividing the incoming value by a given value.

## Example usage

```swift
stream.normalized(by: 50)

upstream  value  |  downstream
20        50     |  0.4
40        50     |  0.8
80        50     |  1.6
```

## MVP

### Expose a normalizedBy operator API

Use `_map` to implement the operator. Accept a number value. Emit the result of `incoming / value`.

```swift
class MotionObservable {
  public func normalized(by value: number) -> MotionObservable<number>
```
