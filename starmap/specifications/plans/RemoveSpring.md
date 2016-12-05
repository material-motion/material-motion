---
layout: page
title: RemoveSpring
status:
  date: Nov 7, 2016
  is: Stable
depends_on:
  - /starmap/specifications/runtime/Plan
  - /starmap/specifications/plans/SpringTo
proposals:
  - proposal:
    initiation_date: Oct 24, 2016
    completion_date: Nov 7, 2016
    state: Accepted
    discussion: "`RemoveSpring` plan"
    discussion_url: https://groups.google.com/forum/#!topic/material-motion/UTnXKlEYOOQ
---

# RemoveSpring specification

## Example: Tossable elements

```swift
Transition TossableElements {
  func gestureDidStart() {
    addPlan(RemoveSpring(from: .layerPosition), to: target)
  }
}
```

## Contract

Removes any active spring from the given target's property.

```swift
Plan RemoveSpring {
  var property
}
```

`property` is any animatable value on the target object.

## Performer considerations

This plan goes hand-in-hand with `SpringTo`.

