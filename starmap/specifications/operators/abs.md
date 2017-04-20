---
layout: page
title: abs
status:
  date: April 20, 2017
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: material-motion
depends_on:
  - /starmap/specifications/operators/foundation/$.distanceFrom
availability:
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/operators/distanceFrom.swift
    tests_url: https://github.com/material-motion/material-motion-swift/blob/develop/tests/unit/operator/distanceFromTests.swift
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

# abs specification

This is an alias for a hypothetical operator, `abs`.

## Overview

`abs` emits the absolute value of a number. We recommend using `distanceFrom(0)` to achieve this result.

## Example usage

```swift
stream.distanceFrom(0)

upstream  |  downstream
 20       |  20
-1        |  1
-50       |  50
```
