---
layout: page
title: PauseSpring
status:
  date: Nov 16, 2016
  is: Drafting
---

# PauseSpring specification

Pauses a spring simulation while a gesture recognizer is active.

## Example: Gestures with springs

```
Interaction AttachedToPosition {
  let position
  func setUp() {
    let plans = [
      Draggable(withGestureRecognizer: dragGestureRecognizer),
      SpringTo(.position, destination: position),
      PauseSpring(.position, whileActive: dragGestureRecognizer)
    ]
    for plan in plans {
      runtime.addPlan(plan, to: element)
    }
  }
}
```

## Contract

```
Plan PauseSpring {
  var property
  var gestureRecognizer: GestureRecognizer
}
```

## Performer considerations

Multiple gesture recognizers can cause a single property to be paused. Consider the following scenario in which a directly-interactive element should stop moving while being dragged, rotated, or scaled:

```
let plans = [
  PauseSpring(.position, whileActive: dragGestureRecognizer),
  PauseSpring(.position, whileActive: rotationGestureRecognizer),
  PauseSpring(.position, whileActive: scaleGestureRecognizer)
]
```

When a gesture recognizer becomes active, every associated property's spring should be paused.

When all gesture recognizers for a given property become inactive, unpause the property's spring. Ensure that you reset the spring's current value and velocity.
