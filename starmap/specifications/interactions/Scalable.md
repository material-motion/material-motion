---
layout: page
title: Scalable
status:
  date: December 20, 2016
  is: Draft
knowledgelevel: L2
depends_on:
  - /starmap/specifications/streams/connections/Property
  - /starmap/specifications/streams/Interaction
library: interactions
---

# Scalable specification

This is the engineering specification for the `Scalable` interaction.

## Overview

Feeds scale starting from an initial scale to a given property.

Example use:

```swift
runtime.connect(Scalable(view: view, containerView: containerView))
```

## MVP

### Expose a Scalable type

```swift
public class Scalable: Interaction
```

### Expose configurable values

All property values should be readonly, all stream values should be settable.

```swift
class Scalable {

  /** The property to which the value stream is expected to write. */
  public const var property: ReactiveProperty<CGFloat>

  /** A stream that emits values to be written to the property. */
  public var valueStream: MotionObservable<CGFloat>

  /** A stream that emits velocity when the gesture recognizer ends. */
  public var velocityStream: MotionObservable<CGFloat>

  /** The gesture recognizer that drives this interaction. */
  public const var gestureRecognizer: ScaleGestureRecognizer
```

### Expose an initializer

Allow a gesture recognizer to be optionally provided.

```swift
class Scalable {
  public init(property: ReactiveProperty<CGFloat>,
              containerElement: Element,
              gestureRecognizer: ScaleGestureRecognizer? = nil)
```

### Store the property

```swift
class Scalable {
  init(...) {
    self.property = property

    ...
```

### Create a gesture recognizer if one was not provided

```swift
class Scalable {
  init(...) {
    ...

    self.gestureRecognizer = gestureRecognizer ?? ScaleGestureRecognizer()
    if self.gestureRecognizer.element == nil {
      containerView.addGestureRecognizer(self.gestureRecognizer)
    }

    ...
```

### Create the value and velocity streams

```swift
class Scalable {
  init(...) {
    ...

    let source = gestureSource(self.gestureRecognizer)
    self.valueStream = source.scaled(from: property)
    self.velocityStream = source.velocity()
```

### Expose a convenience initializer

The convenience initializer should extract the necessary property from the provided element.

```swift
class Scalable {
  public init(element: Element,
              containerElement: Element,
              gestureRecognizer: ScaleGestureRecognizer? = nil)
```
