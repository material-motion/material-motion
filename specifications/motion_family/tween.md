# Tween motion family

The tween motion family allows a director to describe tween animations for properties on an element.

> Note that this motion family can/should compose out to a bridge motion family for a given platform if a reasonable tween system already exists.

## Examples

    Transition Fade {
      func setUp(planEmitter) {
        planEmitter.addPlan(Tween(.opacity, from: 0, to: 1, withTimingFunction: .easeInOut), to: target)
      }
    }

## Public plans

### Tween

Contract: linearly interpolate a target's property from one value to another using a timing function for velocity.

    class Tween {
      var property
      var from
      var to
      var timingFunction
    }

For platforms that support a model/presentation layer separation, the `from` and `to` values can be optional. Consider the following situations:

- Both `from` and `to` are provided. Interpolates between `from` and `to`.

- Only `from` is provided. Interpolates between `from` and the current presentation value of the property.

- Only `to` is provided. Interpolates between the current value of the property and `to`.

## Performers

### TweenPerformer

Supported plans: `Tween`.

Fulfills each provided Tween animation. If multiple tweens are added for the same property then the latest tween is used.
