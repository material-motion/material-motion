---
layout: page
title: Streams
permalink: /starmap/specifications/primitives/streams/
---

# Streams

A light-weight implementation of the Observable pattern designed specifically for use in motion
design. It is based in spirit upon the
[ReactiveX](http://reactivex.io/documentation/observable.html) specification, though we've
intentionally trimmed the operators down to the bare essentials required for motion design.

## MVP expectations

### Generic Observable type

Must provide a single genericized Observable type. This is the starting point for any stream.

### Able to create specific Observable types

It should be possible to create specific Observable types. Common examples:

- Gesture recognizer observable.

### Support the following operators

- filter
- map

# Example usage

Extracting velocity from a iOS pan gesture recognizer in Swift:

```swift
class VelocityObservable: Observable<(UIGestureRecognizerState, CGPoint)> {
  init(listeningTo to: UIPanGestureRecognizer) {
    super.init()
    to.addTarget(self, action: #selector(panDidUpdate))
  }

  @objc private func panDidUpdate(gesture: UIPanGestureRecognizer) {
    onNext(value: (gesture.state, gesture.velocity(in: gesture.view)))
  }
}

let pan = UIPanGestureRecognizer()
stream = VelocityObservable(listeningTo: pan)
  .filter     { (state, _) in state == .ended }
  .map        { (_, value) in value }
  .subscribe  { print($0) }
```
