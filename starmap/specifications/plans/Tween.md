---
layout: page
title: Tween
status:
  date: Nov 1, 2016
  is: Stable
proposals:
  - proposal:
    initiation_date: Oct 18, 2016
    completion_date: Oct 19, 2016
    state: Accepted
    discussion: "KeyframeTween plan"
    discussion_url: https://groups.google.com/forum/#!topic/material-motion/rkHX7O_UvyI
  - proposal:
    initiation_date: Oct 18, 2016
    state: Proposed
    discussion: "Zip keyframes together in plan"
    discussion_url: https://groups.google.com/forum/#!topic/material-motion/i1Etw3mOlzE
  - proposal:
    initiation_date: Oct 18, 2016
    completion_date: Nov 1, 2016
    state: Accepted
    discussion: "Rename KeyframeTween to Tween"
    discussion_url: https://groups.google.com/forum/#!topic/material-motion/fmk3ApBolkM
---

# Tween specification

Tween describes an animation that consists of distinct frames of animation.

## Contract

```
Plan Tween {
  var property
  var duration
  var delay
  var values: [Any]
  var offsets: [Float]?
  var interTimingFunctions: [TimingFunction]?
}
```

`property` is any animatable value on the target object.

`duration` is the length of time over which the animation should occur, expressed in milliseconds (e.g. 300 milliseconds).

`delay` is the number of milliseconds that should elapse before a tween begins.

`values` is an array of objects that each define a single frame of the animation.

If `values.length == 1` then the `values[0]` value is treated as the `destination` value of the property.

`offsets` optionally defines the pacing of the animation. Each offset corresponds to its identically-indexed value in the `values` array. Each offset is a floating point number in the range of `[0,1]`. If not provided, each value is assumed to be evenly spaced.

`interTimingFunctions` optionally defines the timing functions to be used between any two values. If `values` is of length `n`, then `interTimingFunctions` should be of length `n-1`. If not provided, each timing function is assumed to be linear.

If `values.length == 1` then `interTimingFunctions[0]` value is treated as the timing function for the animation.
