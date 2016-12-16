---
layout: page
title: Tossable
status:
  date: December 16, 2016
  is: Draft
knowledgelevel: L2
depends_on:
  - /starmap/specifications/primitives/gesture_recognizers/DragGestureRecognizer
  - /starmap/specifications/streams/connections/Property
  - /starmap/specifications/streams/Interaction
  - /starmap/specifications/streams/operators/gesture/$.translated
  - /starmap/specifications/streams/sources/gestureSource
  - /starmap/specifications/streams/sources/springSource
library: interactions
---

# Tossable specification

This is the engineering specification for the concreate `Tossable` interaction type.

## Overview

## MVP

### Expose a Tossable type

```swift
public class Tossable: Interaction
```

### Expose configurable values

All values should be constant and initialized in the initializer.

```swift
class Tossable {
  let spring: Spring<Point>
  let element: Element

  let destination: ScopedProperty<Point>
  let positionStream: MotionObservable<Point>
  let initialVelocityStream: MotionObservable<Point>
}
```

### Expose an initializer

Must accept a destination property, the element to toss, and a container element.

```swift
class Tossable {
  init(destination: ScopedProperty<Point>, toss element: Element, container: Element)
}
```

### Store the destination and element

```swift
class Tossable {
  init(destination: ScopedProperty<Point>, toss element: Element, container: Element) {
    self.destination = destination
    self.element = element

    ...
  }
}
```

### Add a drag gesture to the container

```swift
class Tossable {
  init(destination: ScopedProperty<Point>, toss element: Element, container: Element) {
    ...

    let dragGesture = DragGestureRecognizer()
    containerView.addGestureRecognizer(dragGesture)

    ...
  }
}
```

### Create a translation stream

```swift
class Tossable {
  init(destination: ScopedProperty<Point>, toss element: Element, container: Element) {
    ...

    let dragStream = gestureSource(dragGesture)

    let initialPosition = propertyOf(element).center
    let translationStream = dragStream.translated(from: initialPosition, in: container)

    ...
  }
}
```

### Store the initial velocity stream

```swift
class Tossable {
  init(destination: ScopedProperty<Point>, toss element: Element, container: Element) {
    ...

    self.initialVelocityStream = dragStream.onRecognitionState(.ended).velocity(in: container)

    ...
  }
}
```

### Store the position stream

```swift
class Tossable {
  init(destination: ScopedProperty<Point>, toss element: Element, container: Element) {
    ...

    self.spring = Spring(to: destination, initialValue: initialPosition, threshold: 1)
    let springStream = springSource(spring)
    self.positionStream = springStream.toggled(with: translationStream)
  }
}
```
