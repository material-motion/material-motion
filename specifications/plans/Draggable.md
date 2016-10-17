# Draggable

|  | Android | Apple | Web |
| --- | --- | --- | --- |
| Milestone | [Milestone](https://github.com/material-motion/material-motion-family-direct-manipulation-android/milestone/1) | [Milestone](https://github.com/material-motion/material-motion-family-gestures-swift/milestone/1) | &nbsp; |

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
