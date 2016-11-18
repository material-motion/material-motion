---
layout: page
title: PauseSpring
status:
  date: Nov 16, 2016
  is: Drafting
availability:
  - platform:
    name: iOS
    label: pop-swift v1.2
    url: https://github.com/material-motion/pop-swift/releases/tag/v1.2.0
proposals:
  - proposal:
    initiation_date: Nov 17, 2016
    state: Proposed
    discussion: "PauseSpring plan"
    discussion_url: https://groups.google.com/forum/#!topic/material-motion/zBZ6D_uxHx4
---

# PauseSpring specification

Pauses a spring simulation while a gesture recognizer is active.

## Example: Gestures with springs

```
Interaction DragToOpen {
  let closedPosition = {x: 0, y: 0}
  let openPosition = {x: 0, y: 200}
  let boundary = 100
  let willOpen = false
  
  func setUp() {
    let plans = [
      Draggable(withGestureRecognizer: dragGestureRecognizer),
      SpringTo(.position, destination: closedPosition),
      PauseSpring(.position, whileActive: dragGestureRecognizer)
    ]
    
    for plan in plans {
      runtime.addPlan(plan, to: element)
    }
  }
  
  func didDrag(newLocation) {
    # Because the spring is paused, when the boundary is crossed we can change
    # the spring's destination with SpringTo.  When the drag completes,
    # PauseSpring will release the spring to continue to the most recently set 
    # destination.

    let crossed = newLocation.y > boundary

    if (crossed && !willOpen) {
      runtime.addPlan(
        SpringTo(.position, destination: openPosition),
        to: element
      )
      willOpen = true
      
    } else if (!crossed && willOpen) { 
      runtime.addPlan(
        SpringTo(.position, destination: openPosition),
        to: element
      )
      
      willOpen = false
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
