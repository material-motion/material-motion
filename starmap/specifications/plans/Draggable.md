---
layout: page
title: Draggable
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

# Draggable specification

## Overview

Enables an element to be dragged.

## Contract

Delta x and y from the given gesture recognizer are added to the target's `position.x` and `position.y`. If no gesture recognizer is provided, then one is created.

```
Plan Draggable {
  GestureRecognizer panGestureRecognizer?
  Bool shouldAdjustAnchorPointOnGestureStart = false
}
```

## Performer considerations

If `shouldAdjustAnchorPointOnGestureStart` is true, then `ChangeAnchorPoint` is emitted when the gesture recognizer starts.