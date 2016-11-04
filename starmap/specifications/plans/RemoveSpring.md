---
layout: page
title: RemoveSpring
status:
  date: Oct 24, 2016
  is: In review
proposals:
  - proposal:
    initiation_date: Oct 24, 2016
    state: Proposed
    discussion: "`RemoveSpring` plan"
    discussion_url: https://groups.google.com/forum/#!topic/material-motion/UTnXKlEYOOQ
---

# RemoveSpring specification

## Example: Tossable elements

```
Transition TossableElements {
  func gestureDidStart() {
    addPlan(RemoveSpring(from: .layerPosition), to: target)
  }
}
```

## Contract

Removes any active spring from the given target's property.

```
Plan RemoveSpring {
  var property
}
```

`property` is any animatable value on the target object.

## Performer considerations

This plan goes hand-in-hand with `SpringTo`.

