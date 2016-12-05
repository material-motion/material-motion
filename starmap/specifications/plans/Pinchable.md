---
layout: page
title: Pinchable
status:
  date: Oct 18, 2016
  is: Stable
knowledgelevel: L2
library: direct-manipulation
depends_on:
  - /starmap/specifications/runtime/Plan
  - /starmap/specifications/primitives/gesture_recognizers/ScaleGestureRecognizer
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

# Pinchable specification

## Overview

Enables an element's size to be scaled using a pinch gesture.

## Contract

Scale amount from the given gesture recognizer are multiplied to the target's `scale.x` and `scale.y`. If no gesture recognizer is provided, then one is created.

```
Plan Pinchable {
  var pinchGestureRecognizer = PinchGestureRecognizer()
}
```

### pinchGestureRecognizer API

Provide a settable `pinchGestureRecognizer` API.

This value should be initialized with a default `PinchGestureRecognizer` instance.

## Performer considerations

Draggable, Pinchable, and Rotatable can all share the same performer.

If a performer is fulfilling Draggable at the same time as Pinchable, then it must modify the anchor point of the view to ensure that the centroid between the user's fingers is untransformed throughout the gesture.

If a performer is not fulfilling Draggable, then it should keep the anchor point of the view at its center.
