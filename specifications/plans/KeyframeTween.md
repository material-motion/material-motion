Status of this document:
![](../../_assets/under-construction-flashing-barracade-animation.gif)

# KeyframeTween

KeyframeTween describes tween animations that are have more than two distinct frames of animation.

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

## Performer considerations
