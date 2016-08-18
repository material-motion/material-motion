Status of this document:
![](../../_assets/under-construction-flashing-barracade-animation.gif)

# Timeline tween motion family

The timeline tween motion family allows a director to describe tween animations that are placed on a normalized timeline for properties on an element.

The timeline tween motion family's primary utility is in defining **transitions**. A given transition has two directions; we'll use the terms forward and backward to refer to them. If a timeline tween is described as "fade in" during the forward transition, then that same tween will "fade out" on the backward transition.

> Note that this motion family can/should compose to the Tween motion family.

## Examples

A simple bi-directional "fade" transition:

    class FadeTransition: TransitionDirector {
      func setUp(transaction) {
        let timeline = Timeline(self.initialDirection,
                                duration: self.duration)
        let fadeIn = FadeIn(onTimeline: timeline)
        transaction.add(plan: fadeIn, to: forwardElement)
      }
    }

A simple bi-directional "slide" transition:

    class SlideTransition: TransitionDirector {
      func setUp(transaction) {
        let timeline = Timeline(self.initialDirection,
                                duration: self.duration)
        let shiftUp = Move(onTimeline: timeline,
                           from: bottomEdge,
                           to: topEdge)
        transaction.add(plan: shiftUp, to: forwardElement)
      }
    }

## Abstract types

## Public plans

### TimelineTween

## Performers

### TimelineTweenPerformer

A TimelineTweenPerformer is expected to generate Tween plans for the specified transition direction.

For example, if TimelineTweenPerformer receives the following TimelineTween:

    TimelineTween(property: "opacity",
                  from: 0,
                  to: 1)

And the direction is "forward", then this performer should emit the following plan:

    let delay = timelineTween.start * timeline.duration
    let duration = (timelineTween.end - timelineTween.start) * timeline.duration
    
    Tween(property: timelineTween.property,
          from: timelineTween.from,
          to: timelineTween.to,
          delay: delay
          duration: duration)

If the direction is "backward", then this performer should emit the following plan:

    let delay = (1 - timelineTween.end) * timeline.duration
    let duration = (timelineTween.end - timelineTween.start) * timeline.duration
    
    Tween(property: timelineTween.property,
          from: timelineTween.to,
          to: timelineTween.from,
          delay: delay
          duration: duration)
