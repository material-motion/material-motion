---
layout: page
title: Draggable
status:
  date: March 2, 2017
  is: Stable
interfacelevel: L1
implementationlevel: L2
library: material-motion
depends_on:
  - /starmap/specifications/interactions/
---

# Draggable specification

This is the engineering specification for the `Draggable` interaction.

## Overview

When the gesture begins, reads and caches the current property value.

As the gesture changes, adds the gesture's translation to the cached property value and writes the
result to the property.

Example use:

```swift
runtime.add(Draggable(), to: view)
```

## MVP

### Expose a Draggable type

```swift
public class Draggable: Interaction
```

### Expose configurable values

```swift
class Draggable {

  /** The property to which the value stream is expected to write. */
  public let property: ReactiveProperty<CGPoint>

  /** A stream that emits values to be written to the property. */
  public var valueStream: MotionObservable<CGPoint>

  /** A stream that emits velocity when the gesture recognizer ends. */
  public var velocityStream: MotionObservable<CGPoint>

  /** The gesture recognizer that drives this interaction. */
  public let gestureRecognizer: DragGestureRecognizer
```

### Expose an initializer

Allow a gesture recognizer to be optionally provided.

```swift
class Draggable {
  public init(property: ReactiveProperty<CGPoint>,
              containerElement: Element,
              gestureRecognizer: DragGestureRecognizer? = nil)
```

### Store the property

```swift
class Draggable {
  init(...) {
    self.property = property

    ...
```

### Create a gesture recognizer if one was not provided

```swift
class Draggable {
  init(...) {
    ...

    self.gestureRecognizer = gestureRecognizer ?? DragGestureRecognizer()
    if self.gestureRecognizer.element == nil {
      containerView.addGestureRecognizer(self.gestureRecognizer)
    }

    ...
```

### Create the value and velocity streams

```swift
class Draggable {
  init(...) {
    ...

    let source = gestureSource(self.gestureRecognizer)
    self.valueStream = source.translated(from: property, in: containerView)
    self.velocityStream = source.velocity(in: containerView)
```

### Expose a convenience initializer

The convenience initializer should extract the necessary property from the provided element.

```swift
class Draggable {
  public init(element: Element,
              containerElement: Element,
              gestureRecognizer: DragGestureRecognizer? = nil)
```
