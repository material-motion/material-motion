---
layout: page
title: TranslationGestureRecognizer
status:
  date: December 4, 2016
  is: Stable
knowledgelevel: L2
library: gestures
depends_on:
  - /starmap/specifications/gesture_recognizers/GestureRecognizer
availability:
  - platform:
    name: Android
    url: https://github.com/material-motion/gestures-android/blob/develop/library/src/main/java/com/google/android/material/motion/gestures/TranslationGestureRecognizer.java
  - platform:
    name: iOS
    url: https://developer.apple.com/reference/uikit/uipangesturerecognizer
---

# TranslationGestureRecognizer specification

This is the engineering specification for the `TranslationGestureRecognizer` object.

## Overview

A translation gesture recognizer listens to input events and generates translation events relative
to an initial position.

If multiple input events are being received simultaneously — e.g. multiple fingers — then the
centroid of the events should be used in all calculations.

## MVP

### Is a GestureRecognizer

`TranslationGestureRecognizer` conforms to the `GestureRecognizer` protocol.

Pseudo-code example:

```swift
class TranslationGestureRecognizer: GestureRecognizer {
}
```

### Translation API

Expose an API for reading the current translation of the gesture recognizer in relation to the
associated element.

The translation should be expressed in individual components for platform's available axis of
movement. For example, on a touch screen this might be a two-dimensional vector consisting of an
x and a y translation.

```swift
class TranslationGestureRecognizer {
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
class TranslationGestureRecognizer {
  func velocity() -> Vector
```

### Recognition threshold API

Expose an API for setting the translation threshhold that must be passed before this gesture
recognizer begins emitting `Changed` gesture events.

The default value is platform-dependent.

```swift
class TranslationGestureRecognizer {
  var recognitionThreshold: Vector
```
