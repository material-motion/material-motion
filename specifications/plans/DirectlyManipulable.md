# DirectlyManipulable

|  | Android | Apple | Web |
| --- | --- | --- | --- |
| Milestone | [Milestone](https://github.com/material-motion/material-motion-family-direct-manipulation-android/milestone/1) | [Milestone](https://github.com/material-motion/material-motion-family-gestures-swift/milestone/1) | &nbsp; |

## Overview

Enables an element to be manipulated with multiple simultaneous touch interactions in a natural manner.

## Example: Sticker editor

Scenario: Placing stickers on a photo\/video. Each sticker can be dragged, pinched, and rotated.

```
Interaction Sticker {
  let sticker

  func setUp(planEmitter) {
    planEmitter.addPlan(DirectlyManipulable(), to: sticker)
  }
}
```

## Contract

Registers Draggable, Pinchable, and Rotatable to the given target. May be provided with pre-configured gesture recognizer instances. If no gesture recognizer is provided, one will be created on the target.

```
Plan DirectlyManipulable {
  GestureRecognizer panGestureRecognizer?
  GestureRecognizer pinchGestureRecognizer?
  GestureRecognizer rotateGestureRecognizer?
}
```
