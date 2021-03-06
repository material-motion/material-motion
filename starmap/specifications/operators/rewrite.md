---
layout: page
title: rewrite
status:
  date: February 21, 2016
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: material-motion
depends_on:
  - /starmap/specifications/operators/foundation/$._nextOperator
availability:
  - platform:
    name: Android
    url: https://github.com/material-motion/material-motion-android/blob/develop/library/src/main/java/com/google/android/material/motion/operators/Rewrite.java
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/operators/rewrite.swift
    tests_url: https://github.com/material-motion/material-motion-swift/blob/develop/tests/unit/operator/rewriteTests.swift
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

# rewrite specification

This is the engineering specification for the `MotionObservable` operator: `rewrite`.

## Overview

`rewrite` transforms incoming values into new outgoing values using a dictionary of key-value pairs.

Example usage:

```swift
stream.rewrite([.state1: 100, .state2: 0])

upstream  values                      |  downstream
.state1   [.state1: 100, .state2: 0]  |  100
.state2   [.state1: 100, .state2: 0]  |  0
.state3   [.state1: 100, .state2: 0]  |  
```

## MVP

### Expose rewrite operator API

Return a new MotionObservable of type U.

```swift
class MotionObservable<T> {

  public func rewrite<U>(values: [T: U]) -> MotionObservable<U>
```

### Only emit when a transformation is possible

```swift
class MotionObservable<T> {

  func rewrite<U>(_ values: [T: U]) -> MotionObservable<U> {
    return _nextOperator { value, next in
      if let rewritten = values[value] {
        next(rewritten)
      }
    }
  }
```
