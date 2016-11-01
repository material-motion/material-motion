# BasicTween

| Discussion thread | Moderator | Status |
|:------------------|:-------|:-------|
| [Should we enforce one Tween per property?](https://github.com/material-motion/material-motion-family-tween-android/issues/6) | pingpongboss | Proposed on Oct 12, 2016 |
| [Rename Tween to BasicTween](https://groups.google.com/forum/#!topic/material-motion/fmk3ApBolkM) | appsforartists | Approved on Nov 1, 2016 |

## Example: Fade in

```
Transition Fade {
  func setUp(planEmitter) {
    planEmitter.addPlan(
      Tween(
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
Plan Tween {
  var property
  var from
  var to
  var timingFunction
  var duration
  var delay
}
```

`property` is any animatable value on the target object.

`from` is a value whose types matches that of the property.

`to` is a value whose types matches that of the property.

`timingFunction` is a cubic-bezier timing function.

`duration` is the length of time over which the animation should occur, expressed in milliseconds (e.g. 300 milliseconds).

`delay` is the number of milliseconds that should elapse before a tween begins.

-----

For platforms that support a model/presentation layer separation, the `from` and `to` values can be optional. Consider the following situations:

* Both `from` and `to` are provided. Interpolates between `from` and `to`.

* Only `from` is provided. Interpolates between `from` and the current presentation value of the property.

* Only `to` is provided. Interpolates between the current value of the property and `to`.

## Performer considerations

If multiple Tweens are added for the same property then the latest tween is used.
