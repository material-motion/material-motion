# Momentum conservation motion family

The momentum conservation family allows momentum to be preserved when the desired destination of a property changes. In practice this often means using springs.

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

Contract: one or more one-dimensional springs pull a property's current value to a provided `destination`.

    class AnchoredSpring {
      var property
      var destination
    }

### ConfigureSpring

Contract: configure the behavior of the spring associated with a given property.

    class ConfigureSpring {
      var property
      var bounciness: SpringBounciness
      var speed: SpringSpeed
    }

    enum SpringBounciness {
      case Bouncy(scalar)
      case NotBouncy
    }

    enum SpringSpeed {
      case Fast(scalar)
      case Slow(scalar)
    }

## Performers

### SpringPerformer

Supported plans: `SpringTo`, `ConfigureSpring`.

Use springs to pull the target property's current value towards the last-provided destination.

Create state required to simulate a spring when an `AnchoredSpring` is provided for a new property.

Preserve velocity when a property's destination changes.

`ConfigureSpring` changes the behavior of any active or future springs.

The default behavior for all springs:

- springiness = 15
- bounciness = 5
