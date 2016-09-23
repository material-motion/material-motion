# Springs motion family

The springs motion family allows a director to attach simulated one-dimensional springs to properties on an element.

> Note that this motion family can/should compose out to a bridge motion family for a given platform if a reasonable spring solution already exists.

## Examples

To animate a rounded-corners square to a new dimension:

    class MorphingInteraction: InteractionDirector {
      let roundedCornerShape
      
      func setUp(transaction) {
        transaction.add(plan: SpringTo(.layerBounds, destination: bounds),
                        to: roundedCornerShape)
        transaction.add(plan: SpringTo(.layerCornerRadius, destination: radius),
                        to: roundedCornerShape)
      }
    }

## Public plans

### SpringTo

Contract: one or more one-dimensional springs pull a property's current value to a provided `toValue`.

    class AnchoredSpring {
      var property
      var toValue
    }

### ConfigureSpring

Contract: configure the behavior of the spring associated with a given property.

    class ConfigureSpring {
      var property
      var bounciness
      var speed
    }

## Performers

### SpringPerformer

Supported plans: `SpringTo`, `ConfigureSpring`.

This performer is expected to use springs to perform the requested simulation defined by any provided `AnchoredSpring` plan.

When an `AnchoredSpring` is provided for a new property the performer creates state required to simulate the spring.

Preserve existing velocity when an `AnchoredSpring` is provided for a property again.