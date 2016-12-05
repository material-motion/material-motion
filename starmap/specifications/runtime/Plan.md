---
layout: page
title: Plan
status:
  date: July 8, 2016
  is: Stable
knowledgelevel: L3
library: runtime
availability:
  - platform:
    name: Android
    label: "runtime-android as of v1.0.0"
    url: https://github.com/material-motion/material-motion-runtime-android
  - platform:
    name: iOS
    label: "runtime-objc as of v1.0.0"
    url: https://github.com/material-motion/material-motion-runtime-objc
  - platform:
    name: JavaScript
    label: "material-motion-runtime as of v1.0.0"
    url: https://www.npmjs.com/package/material-motion-runtime
---

# Plan specification

This is the engineering specification for the `Plan` abstract type.

## Features

- [Serialization](../serialization)

## Overview

A plan is an object representing **what you want something to do** or **how you want it to behave**.

Example plan objects:

- `SquashAndStretch` describes a target squashing and stretching in the direction of its movement.
- `Tween` describes a tween animation.
- `Draggable` describes gestural translation.
- `AnchoredSpring` describes a physical simulation.

## MVP

### Abstract type

`Plan` is a protocol, if your language has that concept.

Pseudo-code example:

    protocol Plan {
    }

### Performer type API

Provide an API that returns an instantiable type of performer that can execute this plan.

Emphasis: `performerType` must **not** be an instance of an object. It must be an object type that the runtime can instantiate at a later time. This restriction ensures that plans or app-level logic can't hand data directly to a performer instance.

Pseudo-code example:

    protocol Plan {
      performerType: Class
    }

### Copyable

Plans can be copied.

Modifications made to the copy do not affect the original.

This can be implemented in a variety of ways. We've included a few options below:

- Immutable types.
- Value types.
- Implement a copy or clone method on a reference type.
