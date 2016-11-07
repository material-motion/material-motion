---
layout: page
title: DragGestureRecognizer
status:
  date: November 7, 2016
  is: Draft
availability:
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

```
class DragGestureRecognizer: GestureRecognizer {
}
```

### Translation API

Expose an API for reading the current translation of the gesture recognizer in relation to the
associated element.

The translation should be expressed in individual components for platform's available axis of
movement. For example, on a touch screen this might be a two-dimensional vector consisting of an
x and a y translation.

```
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

```
class DragGestureRecognizer {
  func velocity() -> Vector
```

### Recognition threshold API

Expose an API for setting the translation threshhold that must be passed before this gesture
recognizer begins emitting `Changed` gesture events.

The default value is platform-dependent.

```
class DragGestureRecognizer {
  var recognitionThreshold: Vector
```
