# Springs motion family

The springs motion family allows a director to attach simulated one-dimensional springs to properties on an element.

> Note that this motion family can/should compose out to a bridge motion family for a given platform if a reasonable spring solution already exists.

## Examples

To animate a rounded-corners square to a new dimension:

    AnchoredSpring(.layerBounds, to: bounds)
    AnchoredSpring(.layerCornerRadius, to: radius)

## Public plans

### AnchoredSpring

Contract: one or more one-dimensional springs pull a property's current value to a provided `toValue`.

    class AnchoredSpring {
      var property
      var toValue
    }

## Performers

### SpringPerformer
