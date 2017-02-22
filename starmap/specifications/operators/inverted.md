---
layout: page
title: inverted
status:
  date: February 21, 2016
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: reactive-motion
depends_on:
  - /starmap/specifications/operators/foundation/$._map
availability:
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/reactive-motion-swift/blob/develop/src/operators/inverted.swift
interaction:
  inputs:
    - input:
      name: upstream
      type: Bool
  outputs:
    - output:
      name: downstream
      type: Bool
---

# inverted specification

This is the engineering specification for the `MotionObservable` operator: `inverted`.

## Overview

`inverted` emits the result of inverting the upstream value.

## Example usage

```swift
stream.inverted()

upstream  downstream
true      false
true      false
false     true
```

## MVP

### Expose an inverted operator API

Use `_map` to implement the operator. Emit the result of `!upstream`.

```swift
class MotionObservable<Bool> {
  public func inverted() -> MotionObservable<Bool>
```
