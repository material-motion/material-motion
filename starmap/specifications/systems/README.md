---
layout: page
permalink: /starmap/specifications/systems/
status:
  date: December 7, 2016
  is: Draft
interfacelevel: L2
implementationlevel: L4
library: reactive-motion
depends_on:
  - /starmap/specifications/observable/MotionObservable
---

# Systems

A system is the beginning of a stream that generates events. Systems are generally functions that
accept some configuration information and return an instance of a MotionObservable.

Systems have two connection shapes: **inline** and **object**.

## Inline connections

This type of system is able to make use of inline function APIs.

```swift
func springToStream(spring: Spring<T>) -> MotionObservable<T> {
  return MotionObservable { observer in
    ... // Configure the spring system

    springSystem.start()

    return {
      springSystem.stop()
    }
  }
}
```

## Object connections

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
