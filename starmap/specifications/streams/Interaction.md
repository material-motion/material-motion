---
layout: page
title: Interaction
status:
  date: December 16, 2016
  is: Draft
knowledgelevel: L2
depends_on:
  - /starmap/specifications/streams/MotionAggregator
library: streams
---

# Interaction specification

This is the engineering specification for the abstract `Interaction` type.

## Overview

An Interaction is a class that represents one or more streams of values that can be connected to
properties.

Example interaction:

```swift
class TapToChangeDestination: Interaction {
  let destination: ReactiveProperty<CGPoint>

  var tapStream: MotionObservable<CGPoint>
  init(destination: ReactiveProperty<CGPoint>, container: Element) {
    self.destination = destination

    let tap = UITapGestureRecognizer()
    container.addGestureRecognizer(tap)

    self.tapStream = gestureSource(tap).onRecognitionState(.recognized).centroid(in: container)
  }

  func connect(with aggregator: MotionAggregator) {
    aggregator.write(tapStream, to: destination)
  }
}

TapToChangeDestination(destination: tossable.destination, container: element)
  .connect(with: aggregator)
```

## MVP

### Expose an abstract type

```swift
public protocol Interaction
```

### Expose a connect API

An interaction implements the connect method to set up the default set of connections one might
expect from the interaction.

```swift
protocol Interaction {
  func connect(with aggregator: MotionAggregator)
}
```
