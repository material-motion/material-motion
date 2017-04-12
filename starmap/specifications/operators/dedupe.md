---
layout: page
title: dedupe
status:
  date: February 21, 2017
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: material-motion
depends_on:
  - /starmap/specifications/operators/foundation/$._nextOperator
availability:
  - platform:
    name: Android
    url: https://github.com/material-motion/material-motion-android/blob/develop/library/src/main/java/com/google/android/reactive/motion/operators/CommonOperators.java
  - platform:
    name: JavaScript
    url: https://github.com/material-motion/material-motion-js/blob/develop/packages/core/src/observables/dedupe.ts
    tests_url: https://github.com/material-motion/material-motion-js/blob/develop/packages/core/src/observables/__tests__/dedupe.test.ts
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/operators/dedupe.swift
    tests_url: https://github.com/material-motion/material-motion-swift/blob/develop/tests/unit/operator/dedupeTests.swift
interaction:
  inputs:
    - input:
      name: upstream
      type: "T: Equatable"
  outputs:
    - output:
      name: downstream
      type: "T: Equatable"
---

# dedupe specification

This is the engineering specification for the `MotionObservable` operator: `dedupe`.

## Overview

`dedupe` emits values from upstream as long as they're different from the previously-emitted value.

## Example usage

```swift
stream.dedupe()

upstream  |  downstream
20        |  20
20        |
80        |  80
20        |  20
```

## MVP

### Expose a dedupe operator API

Use `_nextOperator` to implement the operator. Emit values only if they do not match the
previously-emitted value.

```swift
class MotionObservable<T> {
  public func dedupe() -> MotionObservable<T>
```

### Create local storage for the operator

Store the last-emitted value and whether or not an emission has occurred.

```swift
class MotionObservable<T> {
  func dedupe() -> MotionObservable<T> {
    var emitted = false
    var lastValue: T?
```

### Emit and store the new value

Emit upstream values if we haven't emitted a value before or the new value does not match the
previously-emitted value. Store the newly-received value.

```swift
class MotionObservable<T> {
  func dedupe() -> MotionObservable<T> {
    ...
    return _nextOperator { value, next in
      if emitted && lastValue == value {
        return
      }

      lastValue = value
      emitted = true

      next(value)
    }
  }
```
