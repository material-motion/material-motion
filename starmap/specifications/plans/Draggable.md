---
layout: page
title: Draggable
status:
  date: Oct 18, 2016
  is: Stable
depends_on:
  - /starmap/specifications/primitives/gesture_recognizers/DragGestureRecognizer
availability:
  - platform:
    name: Android
    label: direct-manipulation-android as of v1.0.0
    url: https://github.com/material-motion/family-direct-manipulation-android/releases/tag/1.0.0
  - platform:
    name: iOS
    label: direct-manipulation-swift as of v1.0.0
    url: https://github.com/material-motion/material-motion-family-direct-manipulation-swift/releases/tag/v1.0.0
---

# Draggable specification

## Overview

Enables an element to be dragged.

## Contract

Delta x and y from the given gesture recognizer are added to the target's `position.x` and `position.y`. If no gesture recognizer is provided, then one is created.

```swift
Plan Draggable {
  var dragGestureRecognizer = DragGestureRecognizer()
}
```

### dragGestureRecognizer API

Provide a settable `dragGestureRecognizer` API.

This value should be initialized with a default `DragGestureRecognizer` instance.

## Performer considerations

Draggable, Pinchable, and Rotatable can all share the same performer.

# Proposed features

## axis lock

When enabled, will only allow drags along the given axis.

```swift
enum DraggableAxisLock {
  case horizontal
  case vertical
}
Plan Draggable {
  var axisLock: AxisLock?
```
