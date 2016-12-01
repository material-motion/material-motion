---
layout: page
title: Rotatable
status:
  date: Oct 18, 2016
  is: Stable
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

# Rotatable specification

## Overview

Enables an element to be rotated about the z axis with a gesture.

## Contract

Z rotation from the given gesture recognizer is added to the target's `rotation.z`. If no gesture recognizer is provided, then one is created.

```swift
Plan Rotatable {
  var rotationGestureRecognizer = RotationGestureRecognizer()
}
```

### rotationGestureRecognizer API

Provide a settable `rotationGestureRecognizer` API.

This value should be initialized with a default `RotationGestureRecognizer` instance.

## Performer considerations

Draggable, Pinchable, and Rotatable can all share the same performer.

If a performer is fulfilling Draggable at the same time as Rotatable, then it must modify the anchor point of the view to ensure that the centroid between the user's fingers is untransformed throughout the gesture.

If a performer is not fulfilling Draggable, then it should keep the anchor point of the view at its center.
