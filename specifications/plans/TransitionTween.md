# TransitionTween

| Discussion thread | Status |
|:------------------|:-------|
| [`TransitionTween` plan](https://groups.google.com/forum/#!topic/material-motion/uoBbUAK0LCE) | **Accepted** on November 1, 2016 |

TransitionTween describes tween animations that occur during a transition between two states.

> Note that this motion family can/should compose to [`Tween`](Tween.md) or [`KeyframeTween`](KeyframeTween.md).

## Contract

```
Plan TransitionTween {
  var property
  var backValue
  var foreValue
  var forwardTimingFunction
  var backwardTimingFunction
  var segment: TransitionSegment
  var window: TransitionWindow
}
```

`property` is any animatable value on the target object.

`back` is the destination value when the direction is backward.

`fore` is the destination value when the direction is forward.

`forwardTimingFunction` is the timing function to use when initially animating forward.

`backwardTimingFunction` is the timing function to use when initially animating backward.

`forwardSegment` is the portion of the transition window in which the animation should occur during a forward transition.

`backwardSegment` is the portion of the transition window in which the animation should occur during a backward transition.

`window` is the transition window within which the `segment` applies.

## Example: Fade transition

    TransitionDirector Fade {
      func setUp() {
        let fade = TransitionTween("opacity",
                                window: window,
                                segment: .init(position: 0, length: 1)
                                back: 0,
                                fore: 1)
        addPlan(fadeIn, to: forwardElement)
      }
    }

## Example: Slide transition

    TransitionDirector Slide {
      func setUp() {
        let shiftUp = TransitionTween("position",
                                   window: window,
                                   segment: .init(position: 0, length: 1)
                                   back: bottomEdge,
                                   fore: topEdge)
        addPlan(shiftUp, to: forwardElement)
      }
    }

## Performer considerations

A TransitionTweenPerformer will generate different tweens based on the initial direction. Consider the following examples:

```
window = TransitionWindow(duration: 0.4s)
TransitionTween("opacity",
             window: window,
             segment: .init(position: 0, length: 0.25)
             back: 0,
             fore: 1)
```

When initial direction == forward:

```
let forwardTween = Tween("opacity", duration: 0.1s)
forwardTween.from = 0
forwardTween.to = 1
```

When initial direction == backward:

```
let backwardTween = Tween("opacity", duration: 0.1s)
backwardTween.delay = 0.3s
backwardTween.from = 1
backwardTween.to = 0
```
