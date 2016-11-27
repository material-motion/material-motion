---
layout: page
title: Rotatable
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

# Rotatable specification

## Overview

Enables an element to be rotated about the z axis with a gesture.

## Contract

Z rotation from the given gesture recognizer is added to the target's `rotation.z`. If no gesture recognizer is provided, then one is created.

```
Plan Rotatable {
  var rotationGestureRecognizer = RotationGestureRecognizer()
}
```

### rotationGestureRecognizer API

Provide a settable `rotationGestureRecognizer` API.

This value should be initialized with a default `RotationGestureRecognizer` instance.

## Performer considerations

Draggable, Pinchable, and Rotatable can all share the same performer.
