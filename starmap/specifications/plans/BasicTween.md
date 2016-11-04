---
layout: page
status:
  date: Nov 1, 2016
  is: Stable
proposals:
  - proposal:
    initiation_date: Oct 12, 2016
    state: Proposed
    discussion: Should we enforce one BasicTween per property?
    discussion_url: https://github.com/material-motion/material-motion-family-tween-android/issues/6
  - proposal:
    initiation_date: Oct 18, 2016
    completion_date: Nov 1, 2016
    state: Accepted
    discussion: Rename Tween to BasicTween
    discussion_url: https://groups.google.com/forum/#!topic/material-motion/fmk3ApBolkM
availability:
  - platform:
    name: Android
    label: "family-tween-android as of v1.0.0"
    url: https://github.com/material-motion/material-motion-family-tween-android
  - platform:
    name: iOS
    label: "family-pop-swift as of v1.0.0"
    url: https://github.com/material-motion/material-motion-family-pop-swift
---

# BasicTween

## Example: Fade in

```
Transition Fade {
  func setUp() {
    runtime.addPlan(
      BasicTween(
        .opacity, 
        from: 0, 
        to: 1, 
        withTimingFunction: .easeInOut, 
        duration: 300, 
        delay: 0,
      ), 
      to: target
    )
  }
}
```

## Contract

Linearly interpolate a target's property from one value to another using a timing function for velocity.

```
Plan BasicTween {
  var property
  var from
  var to
  var timingFunction?
  var duration
  var delay
}
```

`property` is any animatable value on the target object.

`from` is a value whose types matches that of the property.

`to` is a value whose types matches that of the property.

`timingFunction` is a cubic-bezier timing function. If not provided, then a linear timing function
is assumed.

`duration` is the length of time over which the animation should occur, expressed in milliseconds (e.g. 300 milliseconds).

`delay` is the number of milliseconds that should elapse before a tween begins.
