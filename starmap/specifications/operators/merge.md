---
layout: page
title: merge
status:
  date: February 21, 2016
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: material-motion
depends_on:
  - /starmap/specifications/observable/MotionObservable
availability:
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/operators/merge.swift
    tests_url: https://github.com/material-motion/material-motion-swift/blob/develop/tests/unit/operator/mergeTests.swift
  - platform:
    name: JavaScript
    url: https://github.com/material-motion/material-motion-js/blob/develop/packages/core/src/operators/merge.ts
    tests_url: https://github.com/material-motion/material-motion-js/blob/develop/packages/core/src/operators/__tests__/merge.test.ts
interaction:
  inputs:
    - input:
      name: upstream
      type: T
    - input:
      name: stream
      type: "MotionObservable<T>"
  outputs:
    - output:
      name: downstream
      type: T
---

# merge specification

This is the engineering specification for the `MotionObservable` operator: `merge`.

## Overview

`merge` emits values as it receives them, both from upstream and from the provided stream.

## Example usage

```swift
stream.merge(with: otherStream)

upstream  otherStream  |  downstream
10                     |  10
          20           |  20
50                     |  50
70                     |  70
          15           |  15
```

## MVP

### Expose a merge operator API

Use `MotionObservable` to implement the operator. Accept a MotionObservable of type T.

```swift
class MotionObservable<T> {
  public func merge(with stream: MotionObservable<T>) -> MotionObservable<T>
```

### Subscribe to both streams and emit their values

Use `MotionObservable` to implement the operator. Accept a MotionObservable of type T.

```swift
class MotionObservable<T> {
  public func merge(with stream: MotionObservable<T>) -> MotionObservable<T> {
    return MotionObservable<T> { observer in
      let upstreamSubscription = self.subscribe(observer: observer)
      let subscription = stream.subscribe(observer: observer)
      return {
        subscription.unsubscribe()
        upstreamSubscription.unsubscribe()
      }
    }
  }
```
