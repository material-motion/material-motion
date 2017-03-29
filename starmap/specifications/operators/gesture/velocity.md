---
layout: page
title: velocity
status:
  date: February 21, 2016
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: material-motion
depends_on:
  - /starmap/specifications/gesture_recognizers/TranslationGestureRecognizer
  - /starmap/specifications/gesture_recognizers/RotationGestureRecognizer
  - /starmap/specifications/gesture_recognizers/ScaleGestureRecognizer
  - /starmap/specifications/operators/foundation/$._map
interaction:
  inputs:
    - input:
      name: upstream
      type: GestureRecognizer
  outputs:
    - output:
      name: downstream
      type: "Point|Float"
---

# velocity specification

This is the engineering specification for the `MotionObservable` operator `velocity` that operates
on GestureRecognizer value types.

## Overview

Calculate the velocity of pointer events.  If `element` is provided, the output units are relative to that element.

Example usage:

```swift
gestureSource(gesture).velocity(in: element?)
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
