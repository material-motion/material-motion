---
layout: page
title: $._map
status:
  date: December 13, 2016
  is: Stable
interfacelevel: L3
implementationlevel: L4
library: reactive-motion
depends_on:
  - /starmap/specifications/operators/foundation/$._nextOperator
related_to:
  - /starmap/specifications/operators/foundation/$._filter
availability:
  - platform:
    name: Android
    label: "streams-android in develop"
    url: https://github.com/material-motion/streams-android
    tests_url: https://github.com/material-motion/streams-android/blob/develop/library/src/test/java/com/google/android/material/motion/streams/MotionObservableTests.java
  - platform:
    name: iOS
    url: https://github.com/material-motion/streams-swift/blob/develop/src/operators/foundation/_map.swift
    tests_url: https://github.com/material-motion/streams-swift/blob/develop/tests/unit/operator/_mapTests.swift
  - platform:
    name: JavaScript
    label: "material-motion-streams in develop"
    url: https://github.com/material-motion/material-motion-js/blob/develop/packages/streams/src/MotionObservable.ts
    tests_url: https://github.com/material-motion/material-motion-js/blob/develop/packages/streams/src/__tests__/MotionObservable-map.test.ts
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

# $._map specification

This is the engineering specification for the `MotionObservable` operator: `_map`.

## Overview

`_map` transforms an incoming value of type `T` to a new value of type `U`. [ReactiveX documentation](http://reactivex.io/documentation/operators/map.html).

## Example usage

```swift
stream._map { point in
  return point.x
}

upstream            downstream
{ x: 10, y: 10 }    10
{ x: 50, y: 10 }    50
{ x: 75, y: 50 }    75
```

## MVP

### Expose _map API

Should delegate to `_nextOperator`.

```swift
class MotionObservable<T> {

  public func _map<U>(transform: (T) -> U) -> MotionObservable<U> {
    return _nextOperator { value, next in
      next(transform(value))
    }
  }
```