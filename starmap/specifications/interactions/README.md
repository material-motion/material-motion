---
layout: page
title: Interaction
status:
  date: March 2, 2017
  is: Stable
interfacelevel: L2
implementationlevel: L4
library: reactive-motion
permalink: /starmap/specifications/interactions/
---

# Interaction specification

This is the engineering specification for the abstract `Interaction` type.

## Overview

An Interaction is a class that represents one or more streams of values that can be connected to
properties.

## MVP

### Expose an abstract type

```swift
public protocol Interaction
```

### Expose an add API

An interaction implements the `add` method to set up the default set of connections one might
expect from the interaction.

```swift
protocol Interaction {
  func add(to property: ReactiveProperty<T>, withRuntime runtime: MotionRuntime)
}
```
