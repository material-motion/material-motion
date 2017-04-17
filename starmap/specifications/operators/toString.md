---
layout: page
title: toString
status:
  date: April 14, 2017
  is: Proposal
interfacelevel: L2
implementationlevel: L3
library: material-motion
depends_on:
  - /starmap/specifications/operators/foundation/$._map
availability:
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/operators/toString.swift
proposals:
  - proposal:
    completion_date: April 14, 2017
    state: Proposal
    discussion: "First proposed."
interaction:
  inputs:
    - input:
      name: upstream
      type: T
  outputs:
    - output:
      name: downstream
      type: String
---

# toString specification

This is the engineering specification for the `MotionObservable` operator: `toString`.

## Overview

`toString` emits a string representation of the upstream value.

Example usage:

```swift
stream.toString()

upstream  |  downstream
20        |  "20"
40        |  "40"
80        |  "80"
```

## MVP

### Expose a toString operator API

Use `_map` to implement the operator.

```swift
class MotionObservable {
  public func toString() -> MotionObservable<String>
```
