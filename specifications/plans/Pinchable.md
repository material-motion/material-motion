# Pinchable

|  | Android | Apple | Web |
| --- | --- | --- | --- |
| Milestone | [Milestone](https://github.com/material-motion/material-motion-family-direct-manipulation-android/milestone/1) | [Milestone](https://github.com/material-motion/material-motion-family-gestures-swift/milestone/1) | &nbsp; |

## Overview

Enables an element's size to be scaled using a pinch gesture.

## Contract

Scale amount from the given gesture recognizer are multiplied to the target's `scale.x` and `scale.y`. If no gesture recognizer is provided, then one is created.

```
Plan Pinchable {
  GestureRecognizer pinchGestureRecognizer?
  Bool shouldAdjustAnchorPointOnGestureStart = true
}
```
