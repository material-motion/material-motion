---
layout: page
permalink: /starmap/specifications/streams/elements/
status:
  date: December 20, 2016
  is: Draft
knowledgelevel: L4
library: streams
depends_on:
  - /starmap/specifications/streams/connections/ReactiveProperty
---

# PositionableElement specification

This is the engineering specification for the `PositionableElement` abstract type.

## Overview

A positionable element has a position property.

## MVP

### Expose a PositionableElement abstract type

```swift
public protocol PositionableElement
```

### Expose reactive properties

All properties should be constant.

```swift
protocol PositionableElement {
  let position: ReactiveProperty<Point>
}
```
