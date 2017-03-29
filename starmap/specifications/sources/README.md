---
layout: page
permalink: /starmap/specifications/sources/
status:
  date: March 2, 2017
  is: Stable
interfacelevel: L2
implementationlevel: L4
library: material-motion
depends_on:
  - /starmap/specifications/observable/MotionObservable
---

# Sources

A source turns an Interaction into a MotionObservable stream.

## Types

There are four primary types of sources:

- Gestures
- Scroll views
- Springs
- Tweens

All sources have the same essential API shape. In Swift:

```swift
func sourceToStream(Source<T>) -> MotionObservable<T>
```

In Java:

```java
Source.from(source) // Returns a MotionObservable
```

## Output types

Gesture recognizers are expected to emit themselves whenever the gesture's state is modified.

Scroll views are expected to emit content offset as a Point type.

Springs and Tweens are expected to support emitting any T value type.

## Connection shapes

There are at least two distinct MotionObservable connection shapes: **inline** and **object**.

### Inline connections

This type of source is able to make use of inline function APIs.

```swift
func springToStream(spring: Spring<T>) -> MotionObservable<T> {
  return MotionObservable { observer in
    ... // Configure the spring source

    springSource.start()

    return {
      springSource.stop()
    }
  }
}
```

### Object connections

Consider the following example of a gestureToStream that we might make on iOS:

```swift
func gestureToStream(_ gesture: UIGestureRecognizer) -> MotionObservable<UIGestureRecognizer> {
  return MotionObservable { observer in
    let connection = GestureConnection(subscribedTo: gesture, observer: observer)
    return {
      connection.disconnect()
    }
  }
}
```

Our gesture recognizer requires an object that can receive target/action events, so we define a
GestureConnection object that receives these events.
