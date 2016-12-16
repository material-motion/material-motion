---
layout: page
title: Spring
status:
  date: December 15, 2016
  is: Draft
knowledgelevel: L2
library: springs
---

# Spring specification

This is the engineering specification for the concrete `Spring` API.

## Overview

## MVP

### Expose Spring API

Should be a class type.

```swift
public final class Spring {
```

This class should be generic with a value `T` For languages that support composite properties such
as position.

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

```swift
class Spring {
  public let destination: ScopedReadable
  public let initialValue: ScopedReadable
  public let initialVelocity: ScopedReadable
```

For generic Springs, all properties should be of type `T`:

```swift
class Spring {
  public let destination: ScopedReadable<T>
  public let initialValue: ScopedReadable<T>
  public let initialVelocity: ScopedReadable<T>
```

### Expose a configuration API

Expose a configuration API that is initialized with default values.

Default is tension of `342` and friction of `30`.

```swift
class Spring {
  public let configuration = ScopedReadable<SpringConfiguration>(SpringConfiguration(tension: 342, friction: 30))
```
