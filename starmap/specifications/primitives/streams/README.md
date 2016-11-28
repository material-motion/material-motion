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

## Streams vs Plans

Streams lean more toward the engineering side of the product development process than the design
tooling side. The reason for this is because of the heavy use of lambdas to build streams from
scratch. Lambdas are inherently difficult to introspect and represent in a tool without making other
trade-offs (performance, platform expectations). *Operators* can be built to reuse lambdas, but
the Material Motion core engineering team generally prefers to spec out Plan types.

We provide support for Streams in specific Plan types when it provides clear engineering
productivity value. The direct manipulation family of plans is one such family. Consider the
following example:

```swift
// Without streams
let draggable = Draggable(withGestureRecognizer: pan)
draggable.axis = .horizontal

// With streams
let stream = TranslationObservable(withPanRecognizer: pan).map { CGPoint(x: 0, y: $0.y) }
let draggable = Draggable(withStream: stream)
```

The general work flow we expect to follow is:

1. Rapidly prototype with streams.
2. Identify common patterns and propose Plan specifications.
3. Build out the plan specifications.

In other words, **use streams for prototyping and plans for production**.

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
