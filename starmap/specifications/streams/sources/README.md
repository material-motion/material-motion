---
layout: page
permalink: /starmap/specifications/streams/sources/
title: Sources
status:
  date: December 7, 2016
  is: Draft
knowledgelevel: L3
library: streams
depends_on:
  - /starmap/specifications/streams/MotionObservable/
---

# Sources

A motion source is the beginning of a motion stream. It produces events often by connecting
to an existing value emitter. A source can be created by invoking a global function that
returns a MotionObservable.

Sources have two connection shapes: inline and object.

## Inline connections

This type of source is able to make use of inline function APIs.

```swift
func springSource(spring: Spring) -> MotionObservable<T> {
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

Consider the following example of a tapSource that we might make on iOS:

```swift
func tapSource(_ gesture: UITapGestureRecognizer) -> MotionObservable<TapSubscription.Value> {
  return MotionObservable { observer in
    let connection = TapConnection(subscribedTo: gesture, observer: observer)
    return {
      connection.disconnect()
    }
  }
}
```

Our tap gesture recognizer requires an object that can receive target/action events, so we create a
TapConnection object that receives these events.
