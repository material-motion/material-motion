---
layout: page
title: Rotatable
status:
  date: December 20, 2016
  is: Draft
knowledgelevel: L2
depends_on:
  - /starmap/specifications/streams/connections/Property
  - /starmap/specifications/streams/Interaction
library: interactions
---

# Rotatable specification

This is the engineering specification for the `Rotatable` interaction.

## Overview

Feeds rotation starting from an initial rotation to a given property.

Example use:

```swift
runtime.connect(Rotatable(view: view, containerView: containerView))
```

## MVP

### Expose a Rotatable type

```swift
public class Rotatable: Interaction
```

### Expose configurable values

All property values should be readonly, all stream values should be settable.

```swift
class Rotatable {

  /** The property to which the value stream is expected to write. */
  public const var property: ReactiveProperty<CGPoint>

  /** A stream that emits values to be written to the property. */
  public var valueStream: MotionObservable<CGPoint>

  /** A stream that emits velocity when the gesture recognizer ends. */
  public var velocityStream: MotionObservable<CGPoint>

  /** The gesture recognizer that drives this interaction. */
  public const var gestureRecognizer: RotationGestureRecognizer
```

### Expose an initializer

Allow a gesture recognizer to be optionally provided.

```swift
class Rotatable {
  public init(property: ReactiveProperty<CGPoint>,
              containerElement: Element,
              gestureRecognizer: RotationGestureRecognizer? = nil)
```

### Store the property

```swift
class Rotatable {
  init(...) {
    self.property = property

    ...
```

### Create a gesture recognizer if one was not provided

```swift
class Rotatable {
  init(...) {
    ...

    self.gestureRecognizer = gestureRecognizer ?? RotationGestureRecognizer()
    if self.gestureRecognizer.element == nil {
      containerView.addGestureRecognizer(self.gestureRecognizer)
    }

    ...
```

### Create the value and velocity streams

```swift
class Rotatable {
  init(...) {
    ...

    let source = gestureSource(self.gestureRecognizer)
    self.valueStream = source.rotated(from: property)
    self.velocityStream = source.velocity()
```

### Expose a convenience initializer

The convenience initializer should extract the necessary property from the provided element.

```swift
class Rotatable {
  public init(element: Element,
              containerElement: Element,
              gestureRecognizer: RotationGestureRecognizer? = nil)
```
