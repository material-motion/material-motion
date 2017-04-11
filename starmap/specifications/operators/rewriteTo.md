---
layout: page
title: rewriteTo
status:
  date: February 20, 2016
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: material-motion
depends_on:
  - /starmap/specifications/operators/foundation/$._map
availability:
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/operators/rewriteTo.swift
    tests_url: https://github.com/material-motion/material-motion-swift/blob/develop/tests/unit/operator/rewriteToTests.swift
  - platform:
    name: JavaScript
    url: https://github.com/material-motion/material-motion-js/blob/develop/packages/core/src/operators/rewriteTo.ts
    tests_url: https://github.com/material-motion/material-motion-js/blob/develop/packages/core/src/operators/__tests__/rewriteTo.test.ts
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

# rewriteTo specification

This is the engineering specification for the `MotionObservable` operator: `rewriteTo`.

## Overview

`rewriteTo` emits the provided value every time it receives a new upstream value.

Example usage:

```swift
stream.rewriteTo(100)

upstream  value  |  downstream
 0.50     100    |  100
 0.25     100    |  100
 0.00     100    |  100
-0.25     100    |  100
-0.50     100    |  100
```

## MVP

### Expose a rewriteTo operator API

Use `_map` to implement the operator. Accept a constant of type `U`. Emit this value when a
new upstream value is received.

```swift
class MotionObservable {
  public func rewriteTo<U>(_ value: U) -> MotionObservable<U>
```
