---
layout: page
title: Tween
status:
  date: Nov 1, 2016
  is: Stable
availability:
  - platform:
    name: Android
    label: tween-android v1.1
    url: https://github.com/material-motion/family-tween-android/releases/tag/1.1.0
  - platform:
    name: iOS
    label: coreanimation-swift v2
    url: https://github.com/material-motion/coreanimation-swift/releases/tag/v2.0.0
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
  - proposal:
    initiation_date: Nov 14, 2016
    completion_date: Nov 15, 2016
    state: Accepted
    discussion: "Add optional timeline property"
    discussion_url: https://groups.google.com/forum/#!topic/material-motion/CSlqlBb92bg
---

# Tween specification

Tween describes an animation that consists of distinct frames of animation.

## Contract

```swift
Plan Tween {
  var property
  var duration
  var delay
  var values: [Any]
  var offsets: [Float]?
  var interTimingFunctions: [TimingFunction]?
  var timeline: Timeline?
}
```

`property` is any animatable value on the target object.

`duration` is the length of time over which the animation should occur, expressed in milliseconds (e.g. 300 milliseconds).

`delay` is the number of milliseconds that should elapse before a tween begins.

`values` is an array of objects that each define a single frame of the animation.

> If `values.length == 1` then the `values[0]` value is treated as the `destination` value of the property.

`offsets` optionally defines the pacing of the animation. Each offset corresponds to its identically-indexed value in the `values` array. Each offset is a floating point number in the range of `[0,1]` and is expected to be absolute and monotonically increasing. If not provided, each value is assumed to be evenly spaced.

`interTimingFunctions` optionally defines the timing functions to be used between any two values. If `values` is of length `n`, then `interTimingFunctions` should be of length `n-1`. If not provided, each timing function is assumed to be linear. If `values.length == 1` then `interTimingFunctions[0]` value is treated as the timing function for the animation.

`timeline` optionally allows a Tween's progress to be driven with a scrubber.

## Performer considerations

If a tween has an associated timeline then the performer's `addPlan` method should invoke the timeline's `begin` method if it hasn't already been. The timeline's `beginTime` value should then be used to properly attach the tween to the correct position in time.

In general, the last-registered Tween should take precedence over earlier Tweens. Consider two tweens, A and B, added in that order. If A == B then B will be the only interpolation to take effect. If A starts before B, then A's tween should take effect until B starts, at which point B should take effect. Similarly if A lasts longer than B, A's tween should resume after B has completed.
