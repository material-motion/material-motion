---
layout: page
permalink: /starmap/specifications/sources/
status:
  date: December 7, 2016
  is: Draft
interfacelevel: L2
implementationlevel: L4
library: reactive-motion
depends_on:
  - /starmap/specifications/observable/MotionObservable
---

# Sources

A source turns an Interaction into a MotionObservable stream.

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
    const var connection = GestureConnection(subscribedTo: gesture, observer: observer)
    return {
      connection.disconnect()
    }
  }
}
```

Our gesture recognizer requires an object that can receive target/action events, so we define a
GestureConnection object that receives these events.
