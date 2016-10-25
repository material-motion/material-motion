# TweenBetween

| Discussion thread | Status |
|:------------------|:-------|
| None | Drafting |

TweenBetween describes tween animations that occur during a transition between two states.

> Note that this motion family can/should compose to [`Tween`](Tween.md) or [`KeyframeTween`](KeyframeTween.md).

## Contract

```
Plan TweenBetween {
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

`backValue` is the destination value when the direction is backward.

`foreValue` is the destination value when the direction is forward.

`forwardTimingFunction` is the timing function to use when initially animating forward.

`backwardTimingFunction` is the timing function to use when initially animating backward.

`segment` is the portion of the transition window in which the animation should occur.

`window` is the transition window within which the `segment` applies.

## Example: Fade transition

    TransitionDirector Fade {
      func setUp() {
        let fade = TweenBetween("opacity",
                                window: window,
                                segment: .init(position: 0, length: 1)
                                backValue: 0,
                                foreValue: 1)
        addPlan(fadeIn, to: forwardElement)
      }
    }

## Example: Slide transition

    TransitionDirector Slide {
      func setUp() {
        let shiftUp = TweenBetween("position",
                                   window: window,
                                   segment: .init(position: 0, length: 1)
                                   backValue: bottomEdge,
                                   foreValue: topEdge)
        addPlan(shiftUp, to: forwardElement)
      }
    }

## Performer considerations

A TweenBetweenPerformer will generate different tweens based on the initial direction. Consider the following examples:

```
window = TransitionWindow(duration: 0.4s)
TweenBetween("opacity",
             window: window,
             segment: .init(position: 0, length: 0.25)
             backValue: 0,
             foreValue: 1)
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
