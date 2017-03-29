---
layout: page
title: delayBy
status:
  date: March 22, 2017
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: material-motion
depends_on:
  - /starmap/specifications/operators/foundation/$._nextOperator
proposals:
  - proposal:
    completion_date: March 22, 2017
    state: Stable
    discussion: "First introduced"
availability:
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/operators/delayBy.swift
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

# delayBy specification

This is the engineering specification for the `MotionObservable` operator: `delayBy`.

## Overview

`delayBy` emits values from upstream after a specified delay amount.

## Example usage

```swift
stream.delay(by: 0.3)

time  |  upstream  |  downstream
0     |  20        |  
0.1   |            |  
0.2   |  80        |  
0.3   |            |  20
```

## MVP

### Expose a delayBy operator API

Use `_nextOperator` to implement the operator. Emit values after the specified delay has passed.

```swift
class MotionObservable<T> {
  public func delay(by: CGFloat) -> MotionObservable<T>
```

### Cancel the delayed invocation on unsubscription

Unsubscription should cancel any values that have not yet been emitted.
