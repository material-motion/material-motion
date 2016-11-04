---
layout: page
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

# Rotatable

## Overview

Enables an element to be rotated about the z axis with a gesture.

## Contract

Z rotation from the given gesture recognizer is added to the target's `rotation.z`. If no gesture recognizer is provided, then one is created.

```
Plan Rotatable {
  GestureRecognizer rotationGestureRecognizer?
  Bool shouldAdjustAnchorPointOnGestureStart = true
}
```

## Performer considerations

If `shouldAdjustAnchorPointOnGestureStart` is true, then `ChangeAnchorPoint` is emitted when the gesture recognizer starts.
