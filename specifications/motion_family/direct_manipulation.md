# Direct manipulation motion family

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

## Public plans

### DirectlyManipulable

Contract: registers Draggable, Pinchable, and Rotatable to the given target.

```
Plan DirectlyManipulable {
  var panGestureRecognizer?
  var pinchGestureRecognizer?
  var rotateGestureRecognizer?
}
```

### Draggable

Contract: delta x and y from the given gesture recognizer are added to the target's `position.x` and `position.y`. If no gesture recognizer is provided, then one is created.

```
Plan Draggable {
  var panGestureRecognizer?
  var shouldAdjustAnchorPointOnGestureStart = false
}
```

### Pinchable

Contract: scale amount from the given gesture recognizer are multiplied to the target's `scale.x` and `scale.y`. If no gesture recognizer is provided, then one is created.

```
Plan Pinchable {
  var pinchGestureRecognizer?
  var shouldAdjustAnchorPointOnGestureStart = true
}
```

### Rotatable

Contract: z rotation from the given gesture recognizer is added to the target's `rotation.z`. If no gesture recognizer is provided, then one is created.

```
Plan Rotatable {
  var rotationGestureRecognizer?
  var shouldAdjustAnchorPointOnGestureStart = true
}
```

## Private plans

Plans that are only accessible within this motion family.

### ChangeAnchorPoint

Contract: the anchor point of the view is immediately changed to the `newAnchorPoint`. The target's position is also updated to avoid noticeable movement of the target.

```
Plan ChangeAnchorPoint {
  var newAnchorPoint
}
```

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

