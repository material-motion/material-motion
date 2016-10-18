Status of this document:
![](../../_assets/under-construction-flashing-barracade-animation.gif)

# KeyframeTween

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

`keyPositions` optionally defines the pacing of the animation. Each position corresponds to its identically-indexed value in the `values` array. Each position is a floating point number in the range of `[0,1]`.

`interTimingFunctions` optionally defines the timing functions to be used between any two values. If `values` is of length `n`, then `interTimingFunctions` should be of length `n-1`.

`timingFunction` optionally defines the timing function that governs the overall pacing of the animation.

## Performer considerations
