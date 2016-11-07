---
layout: page
title: RotationGestureRecognizer
status:
  date: November 7, 2016
  is: Draft
availability:
  - platform:
    name: iOS
    label: "iOS SDK 3.2+ UIRotationGestureRecognizer"
    url: https://developer.apple.com/reference/uikit/uirotationgesturerecognizer
---

# RotationGestureRecognizer specification

This is the engineering specification for the `RotationGestureRecognizer` object.

## Overview

A rotation gesture recognizer listens to input events and generates rotation events relative to
an initial orientation.

This gesture recognizer requires two input independent event streams in order to calculate the
rotation.

## MVP

### Is a GestureRecognizer

`RotationGestureRecognizer` conforms to the `GestureRecognizer` protocol.

Pseudo-code example:

```
class RotationGestureRecognizer: GestureRecognizer {
}
```

### Rotation API

Expose an API for reading the current rotation of the gesture recognizer in relation to the
associated element.

For two-dimensional displays the rotation should be expressed in terms of the z coordinate space.

```
class RotationGestureRecognizer {
  func rotation() -> Number
```

### Velocity API

Expose an API for reading the current angular velocity of the input events in relation to the
associated element.

TODO: Spec out an implementation for calculating velocity.

```
class RotationGestureRecognizer {
  func velocity() -> Number
```

### Recognition threshold API

Expose an API for setting the rotation threshhold that must be passed before this gesture
recognizer begins emitting `Changed` gesture events.

The default value is platform-dependent.

```
class RotationGestureRecognizer {
  var recognitionThreshold: Vector
```

### Event algorithm

When two input streams are registered with the gesture recognizer then a vector should be calculated
from the first stream's position to the second's. This is the reference vector.

Calculate a new vector from the first event stream's position to the second on each new event. The
generated rotation gesture event value is the angle of rotation from the reference vector to the new
vector.
