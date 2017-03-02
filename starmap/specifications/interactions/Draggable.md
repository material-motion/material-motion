---
layout: page
title: Draggable
status:
  date: December 20, 2016
  is: Draft
knowledgelevel: L2
depends_on:
  - /starmap/specifications/streams/connections/Property
  - /starmap/specifications/streams/Interaction
library: interactions
---

# Draggable specification

This is the engineering specification for the `Draggable` interaction.

## Overview

Feeds translation starting from an initial position to a given property.

Example use:

```swift
runtime.connect(Draggable(view: view, containerView: containerView))
```

## MVP

### Expose a Draggable type

```swift
public class Draggable: Interaction
```

### Expose configurable values

All property values should be readonly, all stream values should be settable.

```swift
class Draggable {

  /** The property to which the value stream is expected to write. */
  public const var property: ReactiveProperty<CGPoint>

  /** A stream that emits values to be written to the property. */
  public var valueStream: MotionObservable<CGPoint>

  /** A stream that emits velocity when the gesture recognizer ends. */
  public var velocityStream: MotionObservable<CGPoint>

  /** The gesture recognizer that drives this interaction. */
  public const var gestureRecognizer: DragGestureRecognizer
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
