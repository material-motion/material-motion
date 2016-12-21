---
layout: page
status:
  date: December 20, 2016
  is: Draft
knowledgelevel: L4
library: streams
depends_on:
  - /starmap/specifications/streams/connections/ReactiveProperty
---

# TransformableElement specification

This is the engineering specification for the `TransformableElement` abstract type.

## Overview

A transformable element has independent rotation, scale, and translation properties.

## MVP

### Expose a TransformableElement abstract type

```swift
public protocol TransformableElement
```

### Expose reactive properties

All properties should be constant.

```swift
protocol TransformableElement {
  const var position: ReactiveProperty<Point>
  const var rotation: ReactiveProperty<Number>
  const var scale: ReactiveProperty<Number>
  const var transform: ReactiveProperty<Transform>
}
```
