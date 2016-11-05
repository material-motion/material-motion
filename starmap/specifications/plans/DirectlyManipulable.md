---
layout: page
title: DirectlyManipulable
status:
  date: Oct 18, 2016
  is: Stable
availability:
  - platform:
    name: Android
    label: Milestone
    url: https://github.com/material-motion/material-motion-family-direct-manipulation-android/milestone/1
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

```
Interaction Sticker {
  let sticker

  func setUp(planEmitter) {
    planEmitter.addPlan(DirectlyManipulable(), to: sticker)
  }
}
```

## Contract

Registers [`Draggable`](Draggable), [`Pinchable`](Pinchable), and [`Rotatable`](Rotatable) to the given target. May be provided with pre-configured gesture recognizer instances. If no gesture recognizer is provided, one will be created on the target.

```
Plan DirectlyManipulable {
  GestureRecognizer panGestureRecognizer?
  GestureRecognizer pinchGestureRecognizer?
  GestureRecognizer rotateGestureRecognizer?
}
```

## Performer considerations

Always emits [`ChangeAnchorPoint`](ChangeAnchorPoint) when the first gesture recognizer starts.
