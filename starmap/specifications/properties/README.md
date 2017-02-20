---
layout: page
permalink: /starmap/specifications/properties/
status:
  date: February 19, 2017
  is: Stable
interfacelevel: L2
implementationlevel: L4
library: reactive-motion
---

# Connecting streams with external systems

This is the engineering specification for connecting streams with external information.

## Overview

There are two flows of information in reactive architecture:

- **Inputs**: values that are read into a stream.
- **Outputs**: values that are written from a stream.

### Systems generate dynamic values

A **system** is a MotionObservable connect function that generates values and emits them to a
MotionObservable. Systems can be thought of as entry-points for streams. Systems are generally
**reactively configurable**, meaning changes to their configuration will be immediately reflected in
the values they emit.

Some example systems include:

- Scroll events from a scroll view.
- Values from a physics simulation.
- Interpolated values.
- Gesture recognition events.

### Properties read and write data

A **property** is a target to which a MotionObservable can be written. Properties are generally
initialized with some default value. When no initial value is possible, 0 is a common default.
Properties are often a representation of some thing that's external to the reactive motion runtime,
though they can also be *anonymous* meaning they have no external representation.

Some example properties that represent values external to reactive motion:

- A view's position.
- A view's opacity.
- Values for some business logic.

### Changes to external state

Once a property has been created, the only way it will change state is if it is written to. This
means that if a property represents some external information then it is the responsibility of that
information's owner to keep the property synchronized with any external changes.
