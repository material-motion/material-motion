---
layout: page
title: log
status:
  date: February 20, 2016
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: reactive-motion
depends_on:
  - /starmap/specifications/operators/foundation/$._nextOperator
availability:
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/reactive-motion-swift/blob/develop/src/operators/log.swift
interaction:
  inputs:
    - input:
      name: upstream
      type: T
  outputs:
    - output:
      name: downstream
      type: T
---

# log specification

This is the engineering specification for the `MotionObservable` operator: `log`.

## Overview

`log` writes any upstream value to the console and emits the value without modification.

Example usage:

```swift
stream.log()

upstream  downstream
20        20
40        40
80        80

console
20
40
80
```

## MVP

### Expose a log operator API

Use `_nextOperator` to implement the operator.

```swift
class MotionObservable {
  public func log() -> MotionObservable<T>
```
