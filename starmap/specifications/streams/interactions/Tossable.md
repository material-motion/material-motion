---
layout: page
title: Tossable
status:
  date: December 16, 2016
  is: Draft
knowledgelevel: L2
depends_on:
  - /starmap/specifications/streams/interactions/Attach
  - /starmap/specifications/primitives/gesture_recognizers/DragGestureRecognizer
  - /starmap/specifications/streams/operators/gesture/$.translated
  - /starmap/specifications/streams/sources/GestureSource
library: interactions
---

# Tossable specification

This is the engineering specification for the `Tossable` interaction.

## Overview

The tossable interaction allows an element to be dragged and tossed to a destination.

Example use:

```swift
let tossable = Tossable(position: propertyOf(view).center,
                        to: propertyOf(targetView).center,
                        containerView: view,
                        springSource: popSpringSource)
```

## MVP

### Expose a Tossable type

Subclass the Attach interaction.

```swift
public class Tossable: Attach
```

### Expose configurable values

All property values should be readonly, all stream values should be settable.

```swift
class Tossable {
  /** A stream that emits the pan gesture's velocity when the gesture ends. */
  public var initialVelocityStream: MotionObservable<CGPoint>
```

### Expose an initializer

```swift
class Tossable {
  public init(position: ReactiveProperty<CGPoint>,
              to destination: ReactiveProperty<CGPoint>,
              containerView: UIView,
              springSource: SpringSource<CGPoint>,
              panGestureRecognizer: UIPanGestureRecognizer? = nil)
}
```

### Create a pan gesture recognizer if one was not provided

```swift
class Tossable {
  init(...) {
    let panGestureRecognizer = panGestureRecognizer ?? UIPanGestureRecognizer()
    if panGestureRecognizer.view == nil {
      containerView.addGestureRecognizer(panGestureRecognizer)
    }

    ...
```

### Create a translation stream

```swift
class Tossable {
  init(...) {
    ...

    let dragStream = gestureSource(panGestureRecognizer)
    let translationStream = dragStream.translated(from: position, in: containerView)

    ...
```

### Store the initial velocity stream

```swift
class Tossable {
  init(...) {
    ...

    self.initialVelocityStream = dragStream.onRecognitionState(.ended).velocity(in: container)

    ...
```

### Call super and store the position stream

```swift
class Tossable {
  init(...) {
    ...

    super.init(position: position, to: destination, springSource: springSource)

    self.positionStream = self.positionStream.toggled(with: translationStream)
  }
```
