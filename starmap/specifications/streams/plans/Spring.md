---
layout: page
title: Spring
status:
  date: December 15, 2016
  is: Draft
knowledgelevel: L2
library: streams
---

# Spring specification

This is the engineering specification for the concrete `Spring` type.

## Overview

A Spring can pull a value from an initial position to a destination using a physical simulation.

Example usage:

```swift
const var view = UIView()
const var target = UIView()
const var spring = Spring(to: propertyOf(target).center, initialValue: propertyOf(view).center)
const var spring$ = springSource(spring)
...
```

## MVP

### Expose Spring API

This class should be generic with a value `T`.

```swift
public final class Spring<T> {
```

### Expose a SpringConfiguration API

Expose a class with two properties: tension and friction.

```swift
public final class SpringConfiguration {
  public var tension: Float
  public var friction: Float
}
```

### Expose property APIs

These properties should be provided at initialization time.

`destination` represents the desired final value of the spring. `initialValue` represents the
starting value of the spring. `initialVelocity` represents the initial velocity of the spring.
`threshold` represents the value used to calculate when a spring has come to rest.

```swift
class Spring {
  public const var destination: ReactiveProperty<T>
  public const var initialValue: ReactiveProperty<T>
  public const var initialVelocity: ReactiveProperty<T>
  public const var threshold: ReactiveProperty<Float>
```

### Expose a configuration API

Expose a configuration API that is initialized with default values.

Default is tension of `342` and friction of `30`.

```swift
class Spring {
  public const var configuration: ReactiveProperty<SpringConfiguration>
```

### Expose a default configuration API

The default tension is 342 and the default friction is 30.

```swift
class SpringConfiguration {
  ...

  public static var defaultConfiguration: SpringConfiguration {
    get {
      return SpringConfiguration(tension: 342, friction: 30)
    }
  }
```
