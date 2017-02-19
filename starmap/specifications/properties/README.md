---
layout: page
permalink: /starmap/specifications/properties/
status:
  date: February 19, 2017
  is: Stable
knowledgelevel: L2
library: reactive-motion
---

# Connecting streams with external systems

This is the engineering specification for connecting streams with external systems.

## Overview

There are two primary flows of data we care about:

- **In**: values that are read into a reactive motion stream.
- **Out**: values that are written from a reactive motion stream.

### Systems: reading data in

A **system** is a MotionObservable connect function implementation that reads data from some
external system and writes it to a MotionObservable. Systems can be thought of as entry-points for
reactive motion.

Some example systems include:

- Scroll events from a scroll view.
- Values from a physics simulation.
- Interpolated values.
- Gesture recognition events.

### Properties: writing data out

A **property** is a target to which a MotionObservable can be written. Properties are often a
representation of some thing that's external to the reactive motion runtime. Properties can also be
*anonymous*, meaning they have no external representation.

Some example properties that represent values external to reactive motion:

- A view's position.
- A view's opacity.
- Values for some business logic.
