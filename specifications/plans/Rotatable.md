# Rotatable

|  | Android | Apple | Web |
| --- | --- | --- | --- |
| Milestone | [Milestone](https://github.com/material-motion/material-motion-family-direct-manipulation-android/milestone/1) | [Milestone](https://github.com/material-motion/material-motion-family-gestures-swift/milestone/1) | &nbsp; |

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
