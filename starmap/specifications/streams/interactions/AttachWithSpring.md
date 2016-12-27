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
const var attach = AttachWithSpring(property: propertyOf(view).center,
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

  /** The property to which the value stream is expected to write. */
  public const var property: ReactiveProperty<CGPoint>

  /** A stream that emits values to be written to the property. */
  public var positionStream: MotionObservable<CGPoint>

  /** The destination to which the spring will pull the property. */
  public const var destination: ReactiveProperty<CGPoint>

  /** The initial velocity of the spring. */
  public const var initialVelocity: ReactiveProperty<CGPoint>

  /** The spring configuration governing this interaction. */
  public const var springConfiguration: ReactiveProperty<SpringConfiguration>
```

### Expose an initializer

```swift
class AttachWithSpring {
  public init(property: ReactiveProperty<CGPoint>,
              to destination: ReactiveProperty<CGPoint>,
              springSource: SpringSource<CGPoint>)
}
```

### Store the destination and position

```swift
class AttachWithSpring {
  init(...) {
    self.property = property
    self.destination = destination

    ...
  }
```

### Create a spring and store its exposed properties

Only extract the spring configuration and initial velocity.

```swift
class AttachWithSpring {
  init(...) {
    ...

    const var spring = Spring(to: destination, initialValue: property, threshold: 1)
    self.springConfiguration = spring.configuration
    self.initialVelocity = spring.initialVelocity

    ...
  }
```

### Store the value stream

```swift
class AttachWithSpring {
  init(...) {
    ...

    const var springStream = springSource(spring)
    self.valueStream = springStream
  }
```
