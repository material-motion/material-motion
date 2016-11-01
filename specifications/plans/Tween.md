# Tween

| Proposals | Status |
|:------------------|:-------|
| [`KeyframeTween` plan](https://groups.google.com/forum/#!topic/material-motion/rkHX7O_UvyI) | **Accepted** on October 19, 2016 |
| [Zip keyframes together in plan](https://groups.google.com/forum/?utm_medium=email&utm_source=footer#!topic/material-motion/i1Etw3mOlzE) | Proposed on October 18, 2016 |
| [Rename `KeyframeTween` to `Tween`](https://groups.google.com/forum/?utm_medium=email&utm_source=footer#!topic/material-motion/fmk3ApBolkM) | **Accepted** on November 1, 2016 |

Tween describes an animation that consists of more than two distinct frames of animation.

## Contract

```
Plan Tween {
  var property
  var values: [Any]
  var offsets: [Float]?
  var interTimingFunctions: [TimingFunction]?
}
```

`property` is any animatable value on the target object.

`values` is an array of objects that each define a single frame of the animation.

`offsets` optionally defines the pacing of the animation. Each offset corresponds to its identically-indexed value in the `values` array. Each offset is a floating point number in the range of `[0,1]`. If not provided, each value is assumed to be evenly spaced.

`interTimingFunctions` optionally defines the timing functions to be used between any two values. If `values` is of length `n`, then `interTimingFunctions` should be of length `n-1`. If not provided, each timing function is assumed to be linear.
