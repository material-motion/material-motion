---
layout: page
title: ScaleGestureRecognizer
status:
  date: December 4, 2016
  is: Stable
knowledgelevel: L2
library: gestures
depends_on:
  - /starmap/specifications/primitives/GestureRecognizer
availability:
  - platform:
    name: Android
    label: "gestures-android as of v1.0.0"
    url: https://github.com/material-motion/gestures-android/releases/tag/1.0.0
  - platform:
    name: iOS
    label: "iOS SDK 3.2+ UIPinchGestureRecognizer"
    url: https://developer.apple.com/reference/uikit/uipinchgesturerecognizer
---

# ScaleGestureRecognizer specification

This is the engineering specification for the `ScaleGestureRecognizer` object.

## Overview

A scale gesture recognizer listens to input events and generates scale events relative to an initial
scale.

This gesture recognizer requires two input independent event streams in order to calculate the
scale.

## MVP

### Is a GestureRecognizer

`ScaleGestureRecognizer` conforms to the `GestureRecognizer` protocol.

Pseudo-code example:

```swift
class ScaleGestureRecognizer: GestureRecognizer {
}
```

### Scale API

Expose an API for reading the current scale of the gesture recognizer in relation to the
associated element.

For two-dimensional displays the scale should be expressed in terms of a linear scale applied to
both the x and y components.

```swift
class ScaleGestureRecognizer {
  func scale() -> Number
```

### Velocity API

Expose an API for reading the current scale velocity of the input events in relation to the
associated element.

TODO: Spec out an implementation for calculating velocity.

```swift
class ScaleGestureRecognizer {
  func velocity() -> Number
```

### Recognition threshold API

Expose an API for setting the scale threshhold that must be passed before this gesture recognizer
begins emitting `Changed` gesture events.

The default value is platform-dependent.

```swift
class ScaleGestureRecognizer {
  var recognitionThreshold: Vector
```

### Event algorithm

When two input streams are registered with the gesture recognizer then a vector should be calculated
from the first stream's position to the second's. This is the reference vector.

Calculate a new vector from the first event stream's position to the second on each new event. The
generated scale gesture event value is the relative length of this new vector to the reference
vector.
