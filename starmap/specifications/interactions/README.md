---
layout: page
title: Interaction
status:
  date: March 2, 2017
  is: Stable
interfacelevel: L2
implementationlevel: L4
library: material-motion
depends_on:
  - /starmap/specifications/properties/ReactiveProperty
  - /starmap/specifications/runtime/
permalink: /starmap/specifications/interactions/
---

# Interaction specification

This is the engineering specification for the abstract `Interaction` type.

## Overview

An Interaction is a class that represents one or more streams of values that can be written to
reactive properties.

## API guidelines

### Interactions are objects

Many interactions expose one or more configurable properties as reactive properties. Interactions being objects makes it easy to group these properties together.

### Constant variables only

All variables on an interaction instance must be constant.

### Reactive properties for post-add changes

If a variable can be changed post-add, the variable should be a `ReactiveProperty`. E.g. the destination of a spring.

### Interaction instances can be registered to many targets

For example, a Spring might be added to many views. Each view will move to the same destination. Each target should receive its own independent system.

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
