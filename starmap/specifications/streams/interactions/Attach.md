---
layout: page
title: Attach
status:
  date: December 19, 2016
  is: Draft
knowledgelevel: L2
depends_on:
  - /starmap/specifications/streams/connections/Property
  - /starmap/specifications/streams/Interaction
  - /starmap/specifications/streams/sources/SpringSource
library: interactions
---

# Attach specification

This is the engineering specification for the `Attach` interaction.

## Overview

Attach pulls a position toward a destination using a spring.

Example use:

```swift
let attach = Attach(position: propertyOf(view).center,
                    to: propertyOf(targetView).center,
                    springSource: popSpringSource)
```

## MVP

### Expose an Attach type

```swift
public class Attach: Interaction
```

### Expose configurable values

All values should be constant and initialized in the initializer.

```swift
class Attach {

  /** The position to which the position stream is expected to write. */
  public let position: ReactiveProperty<CGPoint>

  /** A stream that emits positional values to be written to the view. */
  public var positionStream: MotionObservable<CGPoint>

  /** The destination to which the spring will pull the view. */
  public let destination: ReactiveProperty<CGPoint>

  /** The initial velocity of the spring. */
  public let initialVelocity: ReactiveProperty<CGPoint>

  /** The spring configuration governing this interaction. */
  public let springConfiguration: ReactiveProperty<SpringConfiguration>
```

### Expose an initializer

Must accept a destination property, the element to toss, and a container element.

```swift
class Attach {
  public init(position: ReactiveProperty<CGPoint>,
              to destination: ReactiveProperty<CGPoint>,
              springSource: SpringSource<CGPoint>)
}
```

### Store the destination and position

```swift
class Attach {
  init(...) {
    self.destination = destination
    self.position = position

    ...
  }
```

### Create a spring and store its exposed properties

Only extract the spring configuration and initial velocity.

```swift
class Attach {
  init(...) {
    ...

    let spring = Spring(to: destination, initialValue: position, threshold: 1)
    self.springConfiguration = spring.configuration
    self.initialVelocity = spring.initialVelocity

    ...
  }
```

### Store the position stream

```swift
class Attach {
  init(...) {
    ...

    let springStream = springSource(spring)
    self.positionStream = springStream
  }
```
