---
layout: page
permalink: /starmap/specifications/streams/interactions/
title: Interactions
status:
  date: December 15, 2016
  is: Draft
knowledgelevel: L2
library: streams
---

# Interactions

An interactions is an object that creates streams from a set of objects and properties.

For example:

```swift
class TossableInteraction {
  const var spring: Spring<CGPoint>
  const var positionStream: MotionObservable<CGPoint>
  const var initialVelocityStream: MotionObservable<CGPoint>

  init(destination: ReactiveProperty<CGPoint>, view: UIView) {
    const var dragGesture = TranslationGestureRecognizer()
    const var dragStream = gestureSource(dragGesture)
    self.initialVelocityStream = dragStream.onRecognitionState(.ended).velocity(in: view)

    self.spring = Spring(to: destination,
                         initialValue: propertyOf(view).center,
                         initialVelocity: property(withInitialValue: CGPoint(x: 0, y: 0)))
    const var springStream = springSource(spring)
    self.positionStream = springStream.toggled(with: dragStream.centroid(in: view))
  }
}

const var tossable = TossableInteraction(destination: someDestination, view: view)

aggregator.write(tossable.initialVelocityStream,
                 to: tossable.spring.initialVelocity)
aggregator.write(tossable.positionStream,
                 to: propertyOf(view).center)
```
