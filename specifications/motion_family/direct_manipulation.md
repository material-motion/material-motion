# Direct manipulation motion family

|  | Android | Apple |
| --- | --- | --- |
| Milestone | [Milestone](https://github.com/material-motion/material-motion-family-direct-manipulation-android/milestone/1) | [Milestone](https://github.com/material-motion/material-motion-family-gestures-swift/milestone/1) |

## Overview

The direct manipulation motion family allows a director to describe gesture manipulation of elements.

## Performers

### DirectManipulationPerformer

Supported plans: `DirectlyManipulable`, `Draggable`, `Pinchable`, and `Rotatable`.

`DirectlyManipulable` emits `Draggable`, `Pinchable`, `Rotatable`, `AnchorPointAdjustable` when the plan is added.

If any registered plan's `shouldAdjustAnchorPointOnGestureStart` is true, then `ChangeAnchorPoint` is emitted when the first gesture recognizer starts.

