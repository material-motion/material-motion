---
layout: page
title: ignoreUntil
status:
  date: April 11, 2017
  is: Proposed
interfacelevel: L2
implementationlevel: L3
library: material-motion
depends_on:
  - /starmap/specifications/observable/MotionObservable
  - /starmap/specifications/operators/foundation/$._filter
availability:
  - platform:
    name: Android
    url: https://github.com/material-motion/material-motion-android/blob/develop/library/src/main/java/com/google/android/material/motion/operators/IgnoreUntil.java
interaction:
  inputs:
    - input:
      name: upstream
      type: T
    - input:
      name: expected
      type: T
  outputs:
    - output:
      name: downstream
      type: T
---

# ignoreUntil specification

This is the engineering specification for the `MotionObservable` operator: `ignoreUntil`.

## Overview

`ignoreUntil` ignores values from upstream until `expected` is received, at which point it emits that value and all further values without modification.

## Example usage

```swift
stream.ignoreUntil(expected: 50)

upstream expected  |  downstream
20       50        |
10       50        |
60       50        |
50       50        |  50
10       50        |  10
20       50        |  20
80       50        |  80
```

## MVP

### Expose a ignoreUntil operator API

Accept a single argument defining the expected value.

```swift
class MotionObservable<T> {
  public func ignoreUntil(expected: T) -> MotionObservable<T>
```

### Create local storage for the operator

Store whether the `expected` value has been received.

```swift
class MotionObservable<T> {
  public func ignoreUntil(expected: T) -> MotionObservable<T>
    var received = false
```

### Emit the new value

Use `_filter` to implement the operator. Store if `expected` was received. Only emit upstream values if `received` is true.

```swift
class MotionObservable<T> {
  public func ignoreUntil(expected: T) -> MotionObservable<T>
    ...
    return _filter { value in
      if value == expected {
        received = true
      }
      
      return received
    }
  }
```
