Status of this document:
![](../../_assets/under-construction-flashing-barracade-animation.gif)

# TimelineTween

TimelineTween describes tween animations that are placed on a normalized timeline.

TimelineTween's primary utility is in defining **transitions**.

> Note that this motion family can/should compose to [`Tween`](Tween.md).

## Example: Fade transition

    Transition Fade {
      func setUp(planEmitter) {
        let fadeIn = TimelineTween("opacity", timeline: timeline, back: 0, fore: 1)
        planEmitter.addPlan(fadeIn, to: forwardElement)
      }
    }

## Example: Slide transition

    Transition Slide {
      func setUp(planEmitter) {
        let timeline = Timeline(self.initialDirection,
                                duration: self.duration)
        let shiftUp = Move(onTimeline: timeline,
                           from: bottomEdge,
                           to: topEdge)
        planEmitter.addPlan(shiftUp, to: forwardElement)
      }
    }

## Contract

TODO.

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
