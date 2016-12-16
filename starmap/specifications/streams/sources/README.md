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
func spring(to destination: T) -> MotionObservable<T> {
  return MotionObservable { observer in
    let spring = Spring()
    spring.destination = destination
    spring.onActivate = {
      observer.state(.active)
    }
    spring.onCompletion = {
      observer.state(.atRest)
    }
    spring.start()
    
    return {
      spring.stop()
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

Our tap gesture recognizer requires an object that can receive target/action events, so we've
created a TapConnection object that can receive these events.

Sources represent the connection from an external system into Material Motion.
TapConnection listens to UITapGestureRecognizer events and sends them through the provided
observer's channels.

```swift
final class TapConnection {
  typealias Value = CGPoint

  init(subscribedTo gesture: UITapGestureRecognizer, observer: MotionObserver<Value>) {
    self.gesture = gesture
    self.observer = observer

    gesture.addTarget(self, action: #selector(didTap))

    // Populate the observer with the current gesture state.
    propagate()
  }

  func disconnect() {
    gesture?.removeTarget(self, action: #selector(didTap))
    gesture = nil
  }

  @objc private func didTap() {
    propagate()
  }

  private func propagate() {
    if gesture!.state != .recognized {
      return
    }
    // We simulate an instantaneous active state here:
    observer.state(.active)
    observer.next(value())
    observer.state(.atRest)
  }

  private func state() -> MotionState {
    return gesture!.state == .recognized ? .active : .atRest
  }

  private func value() -> Value {
    return gesture!.location(in: gesture!.view!)
  }

  private var gesture: (UITapGestureRecognizer)?
  private let observer: MotionObserver<Value>
}
```
