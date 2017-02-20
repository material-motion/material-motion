---
layout: page
title: $<GestureRecognizer>.centroid
status:
  date: December 13, 2016
  is: Draft
knowledgelevel: L2
library: streams
depends_on:
  - /starmap/specifications/primitives/gesture_recognizers/GestureRecognizer
  - /starmap/specifications/streams/operators/foundation/$._map
streamtype:
  in: GestureRecognizer
  out: Point
---

# $<GestureRecognizer>.centroid specification

This is the engineering specification for the `MotionObservable` operator `centroid` that operates
on GestureRecognizer value types.

## Overview

Calculate the centroid of touch events in relation to the provided element.

Example usage:

```swift
gestureSource(gesture).centroid(in: element)
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
