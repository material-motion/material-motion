---
layout: page
title: $<GestureRecognizer>.velocity
status:
  date: December 16, 2016
  is: Draft
knowledgelevel: L2
library: streams
depends_on:
  - /starmap/specifications/primitives/gesture_recognizers/TranslationGestureRecognizer
  - /starmap/specifications/primitives/gesture_recognizers/RotationGestureRecognizer
  - /starmap/specifications/primitives/gesture_recognizers/ScaleGestureRecognizer
  - /starmap/specifications/streams/operators/foundation/$._map
streamtype:
  in: GestureRecognizer
  out: Point|Float
---

# $<GestureRecognizer>.velocity specification

This is the engineering specification for the `MotionObservable` operator `velocity` that operates
on GestureRecognizer value types.

## Overview

Calculate the velocity of touch events in relation to the provided element.

Example usage:

```swift
gestureSource(gesture).velocity(in: element)
```

## MVP

### Expose drag velocity API

Should delegate to `_map`. This API should only be available for streams emitting
TranslationGestureRecognizer values.

```swift
extension MotionObservable where T: TranslationGestureRecognizer {
  public func velocity(in element: Element) -> MotionObservable<Point> {
    return _map { gestureRecognizer in
      return gestureRecognizer.velocity(in: element)
    }
  }
}
```

### Expose rotation velocity API

Should delegate to `_map`. This API should only be available for streams emitting
RotationGestureRecognizer values.

```swift
extension MotionObservable where T: RotationGestureRecognizer {
  public func velocity() -> MotionObservable<Float> {
    return _map { gestureRecognizer in
      return gestureRecognizer.velocity()
    }
  }
}
```

### Expose scale velocity API

Should delegate to `_map`. This API should only be available for streams emitting
ScaleGestureRecognizer values.

```swift
extension MotionObservable where T: ScaleGestureRecognizer {
  public func velocity() -> MotionObservable<Float> {
    return _map { gestureRecognizer in
      return gestureRecognizer.velocity()
    }
  }
}
```
