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
public final class Spring<T> {
```

This class should be generic with a value `T` For languages that support composite properties such
as position.

```swift
public final class Spring<T> {
```

### Expose destination and initialValue APIs

These properties should be provided at initialization time.

`destination` represents the desired final value of the spring. `initialValue` represents the
starting value of the spring.

```swift
class Spring {
  public let destination: Property
  public let initialValue: Property
```

### Expose a SpringConfiguration API

Expose a class with two properties: tension and friction.

```swift
public final class SpringConfiguration {
  public var tension: Float
  public var friction: Float
}
```

### Expose a configuration API

Expose a configuration API that is initialized with default values.

```swift
class Spring {
  public let configuration = SpringConfiguration(tension: 342, friction: 30)
```
