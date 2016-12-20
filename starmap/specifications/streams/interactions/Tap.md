---
layout: page
title: Tap
status:
  date: December 16, 2016
  is: Draft
knowledgelevel: L2
depends_on:
  - /starmap/specifications/streams/connections/Property
  - /starmap/specifications/streams/Interaction
library: interactions
---

# Tap specification

This is the engineering specification for the `Tap` interaction.

## Overview

The tap interaction writes to a position property when a tap gesture is recognized.

Example use:

```swift
let tap = Tap(sets: tossable.destination, containerView: view)
```

## MVP

### Expose a Tap type

```swift
public class Tap: Interaction
```

### Expose configurable values

All property values should be readonly, all stream values should be settable.

```swift
class Tap {

  /** The position to which the position stream is expected to write. */
  public let position: ReactiveProperty<CGPoint>

  /** A stream that emits positional values to be written to the view. */
  public var positionStream: MotionObservable<CGPoint>
```

### Expose an initializer

```swift
class Tap {
  public init(sets position: ReactiveProperty<CGPoint>,
                containerView: UIView,
                tapGestureRecognizer: UITapGestureRecognizer? = nil)
```

### Store the position

```swift
class Tap {
  init(...) {
    self.position = position

    ...
```

### Create a tap gesture recognizer if one was not provided

```swift
class Tap {
  init(...) {
    ...

    let tapGestureRecognizer = tapGestureRecognizer ?? UITapGestureRecognizer()
    if tapGestureRecognizer.view == nil {
      containerView.addGestureRecognizer(tapGestureRecognizer)
    }

    ...
```

### Create the position stream

```swift
class Tap {
  init(...) {
    ...

    self.positionStream = gestureSource(tapGestureRecognizer)
      .onRecognitionState(.recognized)
      .centroid(in: containerView)
```
