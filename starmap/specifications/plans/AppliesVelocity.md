---
layout: page
title: AppliesVelocity
status:
  date: Oct 24, 2016
  is: Drafting
depends_on:
  - /starmap/specifications/runtime/Plan
  - /starmap/specifications/plans/SpringTo
---

# AppliesVelocity specification

## Example: Tossable elements

```swift
Transition TossableElements {
  func setUp() {
    let gestureRecognizer = PanGestureRecognizer()
    addPlan(Draggable(withGestureRecognizer: gestureRecognizer), 
            to: target)
    addPlan(AppliesVelocity(gestureRecognizer, appliedTo: .layerPosition), 
            to: target)
  }
}
```

## Contract

Upon successfull completion of a gesture recognizer, adds the velocity to a property's current velocity.

```swift
Plan AppliesVelocity {
  var gestureRecognizer
  var property
}
```

`gestureRecognizer` is the gesture recognizer from which the velocity should be read.

`property` is any animatable value on the target object.

## Performer considerations

This plan goes hand-in-hand with `SpringTo`.
