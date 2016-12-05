---
layout: page
title: DirectlyManipulable
status:
  date: Oct 18, 2016
  is: Stable
depends_on:
  - /starmap/specifications/primitives/gesture_recognizers/DragGestureRecognizer
  - /starmap/specifications/primitives/gesture_recognizers/ScaleGestureRecognizer
  - /starmap/specifications/primitives/gesture_recognizers/RotationGestureRecognizer
availability:
  - platform:
    name: Android
    label: direct-manipulation-android as of v1.0.0
    url: https://github.com/material-motion/family-direct-manipulation-android/releases/tag/1.0.0
  - platform:
    name: iOS
    label: family-direct-manipulation-swift as of v1.0.0
    url: https://github.com/material-motion/material-motion-family-direct-manipulation-swift/releases/tag/v1.0.0
---

# DirectlyManipulable specification

## Overview

Enables an element to be manipulated with multiple simultaneous touch interactions in a natural manner.

## Example: Sticker editor

Scenario: Placing stickers on a photo/video. Each sticker can be dragged, pinched, and rotated.

```swift
Interaction Sticker {
  let sticker

  func setUp(planEmitter) {
    planEmitter.addPlan(DirectlyManipulable(), to: sticker)
  }
}
```

## Contract

Registers [`Draggable`](Draggable), [`Pinchable`](Pinchable), and [`Rotatable`](Rotatable) to the given target. May be provided with pre-configured gesture recognizer instances.

```swift
Plan DirectlyManipulable {
  var dragGestureRecognizer = DragGestureRecognizer()
  var scaleGestureRecognizer = ScaleGestureRecognizer()
  var rotationGestureRecognizer = RotationGestureRecognizer()
}
```

## Performer considerations

Should emit [`Draggable`](Draggable), [`Pinchable`](Pinchable), and [`Rotatable`](Rotatable).

Emit a separate [`AdjustsAnchorPoint`](AdjustsAnchorPoint) for each gesture recognizer.
