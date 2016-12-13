---
layout: page
title: gestureSource
status:
  date: December 12, 2016
  is: Draft
knowledgelevel: L2
library: direct-manipulation
depends_on:
  - /starmap/specifications/primitives/gesture_recognizers/GestureRecognizer
  - /starmap/specifications/streams/MotionObservable/
---

# gestureSource specification

This is the engineering specification for the `gestureSource` API.

## Overview

`gestureSource` connects to an existing gesture recognizer and emits the gesture recognizer on the
next channel whenever the gesture recognizer's state is updated.

Example usage:

```swift
gestureSource(dragGesture).subscribe(...)
```

## MVP

### Expose generic gestureSource API

`gestureSource` is a function. It should be accessible from anywhere. `gestureSource` is genericized
with type T, where T is a type of GestureRecognizer. Returns a MotionObservable of type T.

> Emphasis: note that the type of value this source forwards is a **type of GestureRecognizer**.
> This allows us to build operators that extract relevant information from the gesture recognizer
> on demand rather than pre-emptively generating all possible information.

```swift
public func gestureSource<T: GestureRecognizer>(gesture: T) -> MotionObservable<T>
```

### Implement a GestureConnection object

Is a private class that represents a single connection to a gesture recognizer.

```swift
private final class GestureConnection<T: UIGestureRecognizer> {
```

### GestureConnection is initialized with a gesture and observer

Both values must be stored by the connection.

```swift
class GestureConnection {
  init(subscribedTo gesture: T, observer: MotionObserver<T>)
```

### Add the connection as a listener to the gesture recognizer

This should be done at the time of construction.

```swift
class GestureConnection {
  init(subscribedTo gesture: T, observer: MotionObserver<T>) {
    ...
    gesture.addTarget(self, action: #selector(gestureEvent))
```

### Implement a propagate helper method

Order of propagation should be:

1. `state(active)` if state is active
2. `next(gesture)`
3. `state(atRest)` if state is at rest

This order of operations minimizes the likelihood of the overall system becoming prematurely at
rest.

A gesture is active if it has begun or is in the process of changing. A gesture is at rest if it
has ended, is possible, or has been canceled.

```swift
class GestureConnection {
  private func propagate(_ gesture: UIGestureRecognizer)
```

### GestureConnection immediately propagates to the observer

Ensures that the observer has the latest information in case the gesture recognizer has already
begun.

```swift
class GestureConnection {
  init(subscribedTo gesture: T, observer: MotionObserver<T>) {
    ...
    
    propagate(gesture)
  }
```

### Implement a disconnect method

```swift
class GestureConnection {
  func disconnect() {
    gesture?.removeTarget(self, action: #selector(gestureEvent))
    gesture = nil
  }
```

### Propagate gesture events

```swift
class GestureConnection {
  @objc private func gestureEvent(gesture: UIGestureRecognizer) {
    propagate(gesture)
  }
```
