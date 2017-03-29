---
layout: page
title: translationAddedTo
status:
  date: February 21, 2016
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: material-motion
depends_on:
  - /starmap/specifications/gesture_recognizers/TranslationGestureRecognizer
  - /starmap/specifications/operators/foundation/$._nextOperator
interaction:
  inputs:
    - input:
      name: upstream
      type: TranslationGestureRecognizer
  outputs:
    - output:
      name: downstream
      type: Point
---

# translationAddedTo specification

This is the engineering specification for the `MotionObservable` operator `translationAddedTo` that operates
on TranslationGestureRecognizer value types.

## Overview

Adds the current drag gesture translation to the provided initial position and emits the result.

Example usage:

```swift
gesture.translation(addedTo: propertyOf(target).center, in: view)
```

## MVP

### Expose translationAddedTo API

This API should only be available for streams emitting TranslationGestureRecognizer values. It should
accept an `initialPosition` readable property and an element within which the translations should be
calculated.

```swift
extension MotionObservable where T: TranslationGestureRecognizer {
  func translation(addedTo initialPosition: ScopedReadable<Point>, in element: Element) -> MotionObservable<Point>
}
```

### Cache the initial position on gesture activation

Update the cache on gesture began or gesture changed if no cache currently exists.

```swift
func translation(addedTo initialPosition: ScopedReadable<Point>, in element: Element) -> MotionObservable<Point> {
  var cachedInitialPosition: Point?
  return _nextOperator { value, next in
    if value.state == .began || (value.state == .changed && cachedInitialPosition == nil)  {
      cachedInitialPosition = clone(initialPosition.read())
    }
    ...
  }
}
```

### Blow away the cache when the gesture recognizer is inactive

```swift
func translation(addedTo initialPosition: ScopedReadable<Point>, in element: Element) -> MotionObservable<Point> {
  ...
  return _nextOperator { value, next in
    if value.state == .began || (value.state == .changed && cachedInitialPosition == nil)  {
      ...
    } else if value.state != .began && value.state != .changed {
      cachedInitialPosition = nil
    }
    ...
  }
}
```

### Emit the translationAddedTo initial position

Emit the sum of the cached initial position and the gesture's translation.

```swift
func translation(addedTo initialPosition: ScopedReadable<Point>, in element: Element) -> MotionObservable<Point> {
  ...
  return _nextOperator { value, next in
    ...
    if const var cachedInitialPosition = cachedInitialPosition {
      const var translation = value.translation(in: view)
      next(Point(x: cachedInitialPosition.x + translation.x,
                 y: cachedInitialPosition.y + translation.y))
    }
  }
}
```
