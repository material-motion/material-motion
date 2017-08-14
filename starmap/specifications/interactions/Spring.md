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
let view = UIView()
let target = UIView()
let spring = Spring(to: propertyOf(target).center, initialValue: propertyOf(view).center)
let spring$ = springSource(spring)
...
```

## MVP

### Expose Spring API

This class should be generic with a value `T`.

```swift
public final class Spring<T> {
```

### Expose property APIs

These properties should be provided at initialization time.

`destination` represents the desired final value of the spring. `initialValue` represents the
starting value of the spring. `initialVelocity` represents the initial velocity of the spring.
`threshold` represents the value used to calculate when a spring has come to rest.

```swift
class Spring {
  public let destination: ReactiveProperty<T>
  public let stiffness: ReactiveProperty<Float>
  public let damping: ReactiveProperty<Float>
  public let initialValue: ScopedReadable<T>
  public let initialVelocity: ScopedReadable<T>
  public let threshold: ScopedReadable<Float>
```

### Expose defaults for stiffness and damping

The default stiffness is 342 and the default damping is 30.
