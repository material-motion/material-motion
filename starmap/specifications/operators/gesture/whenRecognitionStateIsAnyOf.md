---
layout: page
title: whenRecognitionStateIsAnyOf
status:
  date: December 13, 2016
  is: Draft
knowledgelevel: L2
library: streams
depends_on:
  - /starmap/specifications/primitives/gesture_recognizers/GestureRecognizer
  - /starmap/specifications/operators/foundation/$._filter
related_to:
  - /starmap/specifications/streams/operators/gesture/whenRecognitionStateIs
streamtype:
  in: GestureRecognizer
  out: GestureRecognizer
---

# whenRecognitionStateIsAnyOf specification

This is the engineering specification for the `MotionObservable` operator `whenRecognitionStateIsAnyOf` that
operates on GestureRecognizer value types.

## Overview

Only invoke next when the gesture recognizer's state matches the provided states.

Example usage:

```swift
gestureSource(gesture).whenRecognitionStateIsAnyOf([began, changed])
```

## MVP

### Expose whenRecognitionStateIsAnyOf API

Should delegate to `_filter`. This API should only be available for streams emitting
GestureRecognizer values.

The output of this operator should be a GestureRecognizer.

```swift
extension MotionObservable where T: GestureRecognizer {
  public func whenRecognitionStateIsAnyOf(states: [UIGestureRecognizerState]) -> MotionObservable<T> {
    return _filter { value in
      return states.contains(value.state)
    }
  }
```
