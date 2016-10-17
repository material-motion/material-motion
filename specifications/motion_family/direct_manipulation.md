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

### AnchorPointPerformer

Supported plans: `ChangeAnchorPoint`.

The following diagram shows the desired effect of changing the anchor point of an element:

![](../../_assets/AnchorPoint.svg)

In pseudo-code:

```
func onGestureInitiated() {
  let initialPositionInElement = Point(element.anchorPoint.x * element.width,
                                       element.anchorPoint.x * element.height)

  let gesturePositionInElement = gesture.positionInElement(element)
  let desiredAnchorPoint = Point(gesturePositionInElement.x / element.width,
                                 gesturePositionInElement.y / height)

  element.anchorPoint = desiredAnchorPoint
  element.position += gesturePositionInElement - originalPositionInElement
}
```

