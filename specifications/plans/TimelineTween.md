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

`from` is a value whose types matches that of the property.

`to` is a value whose types matches that of the property.

`timingFunction` is a cubic-bezier timing function.

`duration` is the length of time over which the animation should occur, expressed in milliseconds (e.g. 300 milliseconds).

`delay` is the number of milliseconds that should elapse before a tween begins.


## Performer considerations

A TimelineTweenPerformer is expected to generate Tween plans for the specified transition direction.

For example, if TimelineTweenPerformer receives the following TimelineTween:

    Tween(onTimeline: timeline,
          property: "opacity",
          from: 0,
          to: 1)

And the direction is "forward", then this performer should emit the following plan:

    let delay = timelineTween.start * timeline.duration
    let duration = (timelineTween.end - timelineTween.start) * timeline.duration
    
    emit Tween(property: timelineTween.property,
               from: timelineTween.from,
               to: timelineTween.to,
               delay: delay
               duration: duration)

If the direction is "backward", then this performer should emit the following plan:

    let delay = (1 - timelineTween.end) * timeline.duration
    let duration = (timelineTween.end - timelineTween.start) * timeline.duration
    
    emit Tween(property: timelineTween.property,
               from: timelineTween.to,
               to: timelineTween.from,
               delay: delay
               duration: duration)
