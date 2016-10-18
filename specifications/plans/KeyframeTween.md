Status of this document:
![](../../_assets/under-construction-flashing-barracade-animation.gif)

# KeyframeTween

KeyframeTween describes an animation that consists of more than two distinct frames of animation.

## Contract

```
Plan KeyframeTween {
  var property
  var values
  var keyPositions
  var interTimingFunctions
  var timingFunction
}
```

`property` is any animatable value on the target object.

`values` is an array of objects that each define a single frame of the animation.

## Performer considerations
