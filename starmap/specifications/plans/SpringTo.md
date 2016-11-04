---
layout: page
title: SpringTo
status:
  date: Oct 18, 2016
  is: Stable
availability:
  - platform:
    name: Android
    label: family-rebound-android as of v1.0.0
    url: https://github.com/material-motion/material-motion-family-rebound-android
  - platform:
    name: iOS
    label: family-pop-swift as of v1.0.0
    url: https://github.com/material-motion/material-motion-family-pop-swift
---

# SpringTo specification

## Example: Rounded corners

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

## Contract

One or more one-dimensional springs pull a property's current value to a provided `destination`.

If a `configuration` is provided then the associated spring's configuration should be updated to match the provided values.

    Plan SpringTo {
      property
      destination
      configuration (optional)
    }

## Types

### SpringConfiguration

Contract: configure the behavior of a SpringTo plan.

    // MVP
    SpringConfiguration {
      friction: float = 30
      tension: float = 342
    }
    
    // Feature: bounciness/speed configuration
    SpringConfiguration {
      bounciness: SpringBounciness
      speed: SpringSpeed
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

## Performer considerations

Use springs to pull the target property's current value towards the last-provided destination.

Create state required to simulate a spring when `SpringTo` is provided for a new property.

Preserve velocity when a property's destination changes.