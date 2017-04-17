---
layout: page
title: log
status:
  date: February 20, 2017
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: material-motion
depends_on:
  - /starmap/specifications/operators/foundation/$._nextOperator
availability:
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/operators/log.swift
  - platform:
    name: JavaScript
    url: https://github.com/material-motion/material-motion-js/blob/develop/packages/core/src/operators/log.ts
    tests_url: https://github.com/material-motion/material-motion-js/blob/develop/packages/core/src/operators/__tests__/log.test.ts
related_to:
  - /starmap/specifications/operators/visualize
proposals:
  - proposal:
    completion_date: March 29, 2017
    state: Stable
    discussion: "Added optional string prefix arg."
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

upstream  |  downstream
20        |  20
40        |  40
80        |  80

console
20
40
80
```

```swift
stream.log(prefix: "The value is:")

upstream  |  downstream
20        |  20
40        |  40
80        |  80

console
The value is: 20
The value is: 40
The value is: 80
```

## MVP

### Expose a log operator API

Use `_nextOperator` to implement the operator. Accept an optional prefix string.

```swift
class MotionObservable {
  public func log(prefix: String? = nil) -> MotionObservable<T>
```
