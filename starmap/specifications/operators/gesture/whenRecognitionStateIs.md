---
layout: page
title: whenRecognitionStateIs
status:
  date: February 21, 2016
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: reactive-motion
depends_on:
  - /starmap/specifications/gesture_recognizers/GestureRecognizer
  - /starmap/specifications/operators/foundation/$._filter
related_to:
  - /starmap/specifications/operators/gesture/whenRecognitionStateIs
interaction:
  inputs:
    - input:
      name: upstream
      type: GestureRecognizer
  outputs:
    - output:
      name: downstream
      type: GestureRecognizer
---

# whenRecognitionStateIs specification

This is the engineering specification for the `MotionObservable` operator `whenRecognitionStateIs` that
operates on GestureRecognizer value types.

## Overview

Only invoke next when the gesture recognizer's state matches the provided states.

Example usage:

```swift
gestureSource(gesture).whenRecognitionStateIs(began)
```

## MVP

### Expose whenRecognitionStateIs API

Should delegate to `_filter`. This API should only be available for streams emitting
GestureRecognizer values.

The output of this operator should be a GestureRecognizer.

```swift
extension MotionObservable where T: GestureRecognizer {
  public func whenRecognitionStateIs(state: GestureRecognizerState) -> MotionObservable<T> {
    return _filter { value in
      return value.state == state
    }
  }
```
