---
layout: page
title: GestureSource
status:
  date: December 12, 2016
  is: Draft
knowledgelevel: L2
library: direct-manipulation
depends_on:
  - /starmap/specifications/primitives/gesture_recognizers/GestureRecognizer
  - /starmap/specifications/streams/MotionObservable/
---

# GestureSource specification

This is the engineering specification for the `GestureSource` type.

## Overview

A `GestureSource` is a function that accepts a gesture recognizer and returns a MotionObservable
capable of emitting gesture recognizers.

Example usage:

```swift
gestureSource(dragGesture).subscribe(...)
```

```java
GestureSource.from(dragGesture).subscribe(...)
```

## MVP

### Expose a GestureSource type

`GestureSource` is a function signature. It accepts a GestureRecognizer and returns a
MotionObservable that emits that same GestureRecognizer instance whenever the gesture recognizer
state is updated.

> Emphasis: note that the type of value this source forwards is a **type of GestureRecognizer**.
> This allows us to build operators that extract relevant information from the gesture recognizer
> on demand rather than pre-emptively generating all possible information.

```swift
public typealias GestureSource<T: GestureRecognizer> = (T) -> MotionObservable<T>
```
