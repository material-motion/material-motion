# DirectlyManipulable

|  | Android | Apple |
| --- | --- | --- |
| Milestone | [Milestone](https://github.com/material-motion/material-motion-family-direct-manipulation-android/milestone/1) | [Milestone](https://github.com/material-motion/material-motion-family-gestures-swift/milestone/1) |

## Overview

The direct manipulation motion family allows a director to describe gesture manipulation of elements.

## Examples

### Sticker editor

Scenario: Placing stickers on a photo\/video. Each sticker can be dragged, pinched, and rotated.

```
Interaction Sticker {
  let sticker

  func setUp(planEmitter) {
    planEmitter.addPlan(DirectlyManipulable(), to: sticker)
  }
}
```

## DirectlyManipulable

Contract: registers Draggable, Pinchable, and Rotatable to the given target.

```
Plan DirectlyManipulable {
  var panGestureRecognizer?
  var pinchGestureRecognizer?
  var rotateGestureRecognizer?
}
```
