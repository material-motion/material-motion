# KeyframeTween

| Proposals | Status |
|:------------------|:-------|
| [`KeyframeTween` plan](https://groups.google.com/forum/#!topic/material-motion/rkHX7O_UvyI) | In review |
| [Zip keyframes together in plan](https://groups.google.com/forum/?utm_medium=email&utm_source=footer#!topic/material-motion/i1Etw3mOlzE) | In review |
| [Make `SimpleTween` sugar for `KeyframedTween`](https://groups.google.com/forum/?utm_medium=email&utm_source=footer#!topic/material-motion/fmk3ApBolkM) | In review |

KeyframeTween describes an animation that consists of more than two distinct frames of animation.

## Contract

```
Plan KeyframeTween {
  var property
  var values: [Any]
  var keyPositions: [Float]?
  var interTimingFunctions: [TimingFunction]?
  var timingFunction: TimingFunction?
}
```

`property` is any animatable value on the target object.

`values` is an array of objects that each define a single frame of the animation.

`keyPositions` optionally defines the pacing of the animation. Each position corresponds to its identically-indexed value in the `values` array. Each position is a floating point number in the range of `[0,1]`. If not provided, each value is assumed to be evenly spaced.

`interTimingFunctions` optionally defines the timing functions to be used between any two values. If `values` is of length `n`, then `interTimingFunctions` should be of length `n-1`. If not provided, each timing function is assumed to be linear.

`timingFunction` optionally defines the timing function that governs the overall pacing of the animation. If not provided, the default pacing is `linear`.
