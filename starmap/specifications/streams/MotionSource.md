---
layout: page
title: MotionSource
status:
  date: December 7, 2016
  is: Draft
knowledgelevel: L4
library: streams
depends_on:
  - /starmap/specifications/streams/IndefiniteObservable
---

# MotionSource concept

A motion source is the beginning of a material motion stream. It produces events by connecting one
system to another. Sources are usually simple global functions that return a MotionObservable.

Sources have two internal shapes: inline and object-oriented.

## Inline source

## Object-oriented source

Consider the following example of a tapSource that we might make on iOS:

```swift
func tapSource(_ gesture: UITapGestureRecognizer) -> MotionObservable<TapProducer.Value> {
  return MotionObservable { observer in
    let subscription = TapProducer(subscribedTo: gesture, observer: observer)
    return {
      subscription.unsubscribe()
    }
  }
}
```

Our tap gesture recognizer requires an object that can receive target/action events, so we've
created a type of object we call a `Producer`.

### Producers

While Sources represent the connection from one system to another, Producers are the literal
connections. In this case our TapProducer listens to UITapGestureRecognizer events and sends
them through the provided observer.

A Producer is a Subscription.

```swift
final class TapProducer: Subscription {
  typealias Value = CGPoint

  init(subscribedTo gesture: UITapGestureRecognizer, observer: MotionObserver<Value>) {
    self.gesture = gesture
    self.observer = observer

    gesture.addTarget(self, action: #selector(didTap))

    // Populate the observer with the current gesture state.
    propagate()
  }

  func unsubscribe() {
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
