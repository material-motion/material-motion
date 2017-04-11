---
layout: page
title: rewriteRange
status:
  date: February 21, 2016
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: material-motion
depends_on:
  - /starmap/specifications/operators/foundation/$._map
availability:
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/operators/rewriteRange.swift
    tests_url: https://github.com/material-motion/material-motion-swift/blob/develop/tests/unit/operator/rewriteRangeTests.swift
  - platform:
    name: JavaScript
    url: https://github.com/material-motion/material-motion-js/blob/develop/packages/core/src/operators/rewriteRange.ts
    tests_url: https://github.com/material-motion/material-motion-js/blob/develop/packages/core/src/operators/__tests__/rewriteRange.test.ts
interaction:
  inputs:
    - input:
      name: upstream
      type: number
    - input:
      name: start
      type: number
    - input:
      name: end
      type: number
    - input:
      name: destinationStart
      type: number
    - input:
      name: destinationEnd
      type: number
  outputs:
    - output:
      name: downstream
      type: number
---

# rewriteRange specification

This is the engineering specification for the `MotionObservable` operator: `rewriteRange`.

## Overview

`rewriteRange` emits a linearly-interpolated mapping from one range to another.

## Example usage

```swift
stream.rewriteRange(start: 0, end: 100, destinationStart: 10, destinationEnd: 20)

upstream start end destinationStart destinationEnd  |  downstream
 10      0     100 10               20              |  11
 50      0     100 10               20              |  15
150      0     100 10               20              |  25
-10      0     100 10               20              |  9
```

## MVP

### Expose a rewriteRange operator API

Use `_map` to implement the operator. Accept four arguments: start, end, destinationStart, and
destinationEnd.

```swift
class MotionObservable<number> {
  public func rewriteRange
  ( start: number,
    end: number,
    destinationStart: number,
    destinationEnd: number
  ) -> MotionObservable<number>
```

### Implement the interpolation

```swift
class MotionObservable<number> {
  func rewriteRange
  ( start: number,
    end: number,
    destinationStart: number,
    destinationEnd: number
  ) -> MotionObservable<number> {
    return _map { value in
      let position = value - start

      let vector = end - start
      if vector == 0 {
        return destinationStart
      }
      let progress = position / vector

      let destinationVector = destinationEnd - destinationStart
      let destinationPosition = destinationVector * progress

      return destinationStart + destinationPosition
    }
  }
```
