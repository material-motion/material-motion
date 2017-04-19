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
  - /starmap/specifications/operators/foundation/$._filter
availability:
  - platform:
    name: Android
    url: https://github.com/material-motion/material-motion-android/blob/develop/library/src/main/java/com/google/android/material/motion/operators/Dedupe.java
  - platform:
    name: JavaScript
    url: https://github.com/material-motion/material-motion-js/blob/develop/packages/core/src/operators/dedupe.ts
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

```swift
class MotionObservable<T> {
  public func dedupe(areEqual?: EqualityCheck) -> MotionObservable<T>
```

### Create local storage for the operator

Store the last-emitted value and whether or not an emission has occurred.

```swift
class MotionObservable<T> {
  func dedupe(areEqual?: EqualityCheck) -> MotionObservable<T> {
    var emitted = false
    var lastValue: T?
```

### Emit and store the new value

Use `_filter` to implement the operator. 
Emit upstream values if we haven't emitted a value before or the new value does not match the
previously-emitted value. Store the newly-received value.

```swift
class MotionObservable<T> {
  func dedupe(areEqual?: EqualityCheck = deepEquals) -> MotionObservable<T> {
    ...
    return _filter { value in
      if emitted && areEqual(lastValue, value) {
        return false
      }

      lastValue = value
      emitted = true

      return true
    }
  }
```

### Check for deep equality by default ###

There are [multiple ways](https://en.wikipedia.org/wiki/Object_copying) to measure equality: referential (e.g. two variables reference the same object), shallow (e.g. the keys and values in two objects are all equivalent) and deep (same as shallow, but recursive if one of the values is an object).  The `==` operator in many languages uses referential equality.

An implementation may provide authors with the ability to choose how to compare values.  If supported, the equality check should default to deep equals.
