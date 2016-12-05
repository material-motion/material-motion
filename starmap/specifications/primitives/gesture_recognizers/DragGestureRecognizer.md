---
layout: page
title: DragGestureRecognizer
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
    label: "iOS SDK 3.2+ UIPanGestureRecognizer"
    url: https://developer.apple.com/reference/uikit/uipangesturerecognizer
---

# DragGestureRecognizer specification

This is the engineering specification for the `DragGestureRecognizer` object.

## Overview

A drag gesture recognizer listens to input events and generates translation events relative to an
initial position.

If multiple input events are being received simultaneously — e.g. multiple fingers — then the
centroid of the events should be used in all calculations.

## MVP

### Is a GestureRecognizer

`DragGestureRecognizer` conforms to the `GestureRecognizer` protocol.

Pseudo-code example:

```swift
class DragGestureRecognizer: GestureRecognizer {
}
```

### Translation API

Expose an API for reading the current translation of the gesture recognizer in relation to the
associated element.

The translation should be expressed in individual components for platform's available axis of
movement. For example, on a touch screen this might be a two-dimensional vector consisting of an
x and a y translation.

```swift
class DragGestureRecognizer {
  func translation() -> Vector
```

### Velocity API

Expose an API for reading the current translation velocity of the input events in relation to the
associated element.

The velocity should be expressed in individual components for platform's available axis of movement.
For example, on a touch screen this might be a two-dimensional vector consisting of an x and a y
velocity.

TODO: Spec out an implementation for calculating velocity.

```swift
class DragGestureRecognizer {
  func velocity() -> Vector
```

### Recognition threshold API

Expose an API for setting the translation threshhold that must be passed before this gesture
recognizer begins emitting `Changed` gesture events.

The default value is platform-dependent.

```swift
class DragGestureRecognizer {
  var recognitionThreshold: Vector
```
