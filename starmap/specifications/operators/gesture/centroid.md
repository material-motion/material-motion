---
layout: page
title: centroid
status:
  date: February 21, 2016
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: reactive-motion
depends_on:
  - /starmap/specifications/gesture_recognizers/GestureRecognizer
  - /starmap/specifications/operators/foundation/$._map
interaction:
  inputs:
    - input:
      name: upstream
      type: GestureRecognizer
  outputs:
    - output:
      name: downstream
      type: Point
---

# centroid specification

This is the engineering specification for the `MotionObservable` operator `centroid` that operates
on GestureRecognizer value types.

## Overview

Calculate the centroid of touch events in relation to the provided element.

Example usage:

```swift
gesture.centroid(in: element)
```

## MVP

### Expose centroid API

Should delegate to `_map`. This API should only be available for streams emitting GestureRecognizer
values.

The output of this operator should be a Point.

```swift
extension MotionObservable where T: GestureRecognizer {
  public func centroid(in element: Element) -> MotionObservable<Point> {
    return _map { gestureRecognizer in
      return gestureRecognizer.centroid(in: element)
    }
  }
}
```
