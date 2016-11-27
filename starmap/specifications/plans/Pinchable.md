---
layout: page
title: Pinchable
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

# Pinchable specification

## Overview

Enables an element's size to be scaled using a pinch gesture.

## Contract

Scale amount from the given gesture recognizer are multiplied to the target's `scale.x` and `scale.y`. If no gesture recognizer is provided, then one is created.

```
Plan Pinchable {
  var pinchGestureRecognizer = PinchGestureRecognizer()
  Bool shouldAdjustAnchorPointOnGestureStart = true
}
```

### pinchGestureRecognizer API

Provide a settable `pinchGestureRecognizer` API.

This value should be initialized with a default `PinchGestureRecognizer` instance.

## Performer considerations

If `shouldAdjustAnchorPointOnGestureStart` is true, emit `ChangeAnchorPoint` when the gesture recognizer starts.

Draggable, Pinchable, and Rotatable can all share the same performer.
