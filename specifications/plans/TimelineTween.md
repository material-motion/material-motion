# TimelineTween

| Discussion thread | Status |
|:------------------|:-------|
| None | Drafting |

TimelineTween describes tween animations that are placed on a normalized timeline.

TimelineTween's primary utility is in defining **transitions**.

> Note that this motion family can/should compose to [`Tween`](Tween.md) or [`KeyframeTween`](KeyframeTween.md).

## Contract

```
Plan TimelineTween {
  var property
  var back
  var fore
  var forwardTimingFunction
  var backwardTimingFunction
  var segment: TimelineSegment
  var timeline: Timeline
}
```

`property` is any animatable value on the target object.

`back` is the destination value when the direction is backward.

`fore` is the destination value when the direction is forward.

`forwardTimingFunction` is the timing function to use when initially animating forward.

`backwardTimingFunction` is the timing function to use when initially animating backward.

`segment` is the portion of the timeline in which the animation should occur.

`timelin` is the timeline to which the `segment` applies.

## Example: Fade transition

    TransitionDirector Fade {
      func setUp() {
        let fade = TimelineTween("opacity", timeline: timeline, back: 0, fore: 1)
        addPlan(fadeIn, to: forwardElement)
      }
    }

## Example: Slide transition

    TransitionDirector Slide {
      func setUp() {
        let shiftUp = TimelineTween("position", timeline: timeline, back: bottomEdge, fore: topEdge)
        addPlan(shiftUp, to: forwardElement)
      }
    }

## Performer considerations

A TimelineTweenPerformer is expected to generate Tween plans for the timeline's initial direction.

If `segment.length == 1` then the performer should emit a [`Tween`](Tween.md) plan.

