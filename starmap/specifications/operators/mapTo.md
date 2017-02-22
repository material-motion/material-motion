---
layout: page
title: $.mapTo
status:
  date: February 20, 2016
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: reactive-motion
depends_on:
  - /starmap/specifications/operators/foundation/$._map
availability:
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/reactive-motion-swift/blob/develop/src/operators/mapTo.swift
interaction:
  inputs:
    - input:
      name: upstream
      type: T
  outputs:
    - output:
      name: downstream
      type: U
---

# $.mapTo specification

This is the engineering specification for the `MotionObservable` operator: `$.mapTo`.

## Overview

`$.mapTo` emits the provided value every time it receives a new upstream value.

Example usage:

```swift
stream.mapTo(100)

upstream  value   downstream
 0.50     100     100
 0.25     100     100
 0.00     100     100
-0.25     100     100
-0.50     100     100
```

## MVP

### Expose a $.mapTo API

Use `_map` to implement the operator. Accept a constant of type `U`. Emit this value when a
new upstream value is received.

```swift
class MotionObservable {
  public func mapTo<U>(_ value: U) -> MotionObservable<U>
```
