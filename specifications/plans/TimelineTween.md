Status of this document:
![](../../_assets/under-construction-flashing-barracade-animation.gif)

# TimelineTween

TimelineTween describes tween animations that are placed on a normalized timeline.

TimelineTween's primary utility is in defining **transitions**.

> Note that this motion family can/should compose to [`Tween`](Tween.md).

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

## Performer considerations

A TimelineTweenPerformer is expected to generate Tween plans for the timeline's initial direction.

TODO: Add pseudo-code for generating Tweens based on the initialDirection.