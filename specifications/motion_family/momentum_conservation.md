# Momentum conservation motion family

|  | Android | Apple |
| --- | --- | --- |
| Milestone | [Milestone](https://github.com/material-motion/material-motion-family-rebound-android/milestone/1) | [Milestone](https://github.com/material-motion/material-motion-family-pop-swift/milestone/1) |

## Overview

The momentum conservation family allows momentum to be preserved when the desired destination of a property changes. In practice this often means using springs.

> Note that this motion family can/should compose out to a bridge motion family for a given platform if a reasonable spring solution already exists.

## Examples

To animate a rounded-corners square to a new dimension:

    Interaction Morphing {
      let roundedCornerShape
      
      func setUp(planEmitter) {
        planEmitter.addPlan(SpringTo(.layerBounds, destination: bounds),
                            to: roundedCornerShape)
        planEmitter.addPlan(SpringTo(.layerCornerRadius, destination: radius),
                            to: roundedCornerShape)
      }
    }

## Public plans

### SpringTo

Contract: one or more one-dimensional springs pull a property's current value to a provided `destination`.

    Plan SpringTo {
      var property
      var destination
    }

### ConfigureSpring

Contract: configure the behavior of the spring associated with a given property.

    Plan ConfigureSpring {
      var property
      
      var bounciness: SpringBounciness
      var speed: SpringSpeed
    
      var friction: float = 30
      var tension: float = 342
    }

    enum SpringBounciness {
      case Bouncy(scalar)
      case NotBouncy
      case Exponential
    }

    enum SpringSpeed {
      case Fast(scalar)
      case Slow(scalar)
    }

## Performers

### SpringPerformer

Supported plans: `SpringTo`, `ConfigureSpring`.

Use springs to pull the target property's current value towards the last-provided destination.

Create state required to simulate a spring when `SpringTo` is provided for a new property.

Preserve velocity when a property's destination changes.

`ConfigureSpring` changes the behavior of any active or future springs.
