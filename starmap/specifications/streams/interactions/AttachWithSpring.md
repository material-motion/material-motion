---
layout: page
title: AttachWithSpring
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

# AttachWithSpring specification

This is the engineering specification for the `AttachWithSpring` interaction.

## Overview

AttachWithSpring pulls a position toward a destination using a spring.

Example use:

```swift
let attach = AttachWithSpring(position: propertyOf(view).center,
                    to: propertyOf(targetView).center,
                    springSource: popSpringSource)
```

## MVP

### Expose an AttachWithSpring type

```swift
public class AttachWithSpring: Interaction
```

### Expose configurable values

All property values should be readonly, all stream values should be settable.

```swift
class AttachWithSpring {

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

```swift
class AttachWithSpring {
  public init(position: ReactiveProperty<CGPoint>,
              to destination: ReactiveProperty<CGPoint>,
              springSource: SpringSource<CGPoint>)
}
```

### Store the destination and position

```swift
class AttachWithSpring {
  init(...) {
    self.destination = destination
    self.position = position

    ...
  }
```

### Create a spring and store its exposed properties

Only extract the spring configuration and initial velocity.

```swift
class AttachWithSpring {
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
class AttachWithSpring {
  init(...) {
    ...

    let springStream = springSource(spring)
    self.positionStream = springStream
  }
```
