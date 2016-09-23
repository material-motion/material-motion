Status of this document:
![](../../_assets/under-construction-flashing-barracade-animation.gif)

# Springs motion family

The springs motion family allows a director to attach simulated one-dimensional springs to properties on an element.

> Note that this motion family can/should compose out to a bridge motion family for a given platform if a reasonable spring solution already exists.

## Examples

To animate a rounded-corners square to a new dimension:

    SpringPlan(.layerBounds, to: bounds)
    SpringPlan(.layerCornerRadius, to: radius)

## Public plans

### SpringPlan

## Performers

### SpringPerformer
