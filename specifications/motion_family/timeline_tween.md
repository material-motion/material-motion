Status of this document:
![](../../_assets/under-construction-flashing-barracade-animation.gif)

# Timeline tween motion family

The timeline tween motion family allows a director to describe tween animations that are placed on a normalized timeline for properties on an element.

The timeline tween motion family's primary utility is in defining **transitions**. A given transition has two directions; we'll use the terms forward and backward to refer to them. If a timeline tween is described as "fade in" during the forward transition, then that same tween will "fade out" on the backward transition.

> Note that this motion family can/should compose to the Tween motion family.

## Examples

    class FadeInTransition: TransitionDirector {
    }

## Abstract types

## Public plans

### Tween

## Performers

### TweenPerformer


