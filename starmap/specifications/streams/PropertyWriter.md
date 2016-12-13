---
layout: page
title: PropertyWriter
status:
  date: December 4, 2016
  is: Draft
knowledgelevel: L3
library: streams
depends_on:
  - /starmap/specifications/streams/MotionObservable
---

# PropertyWriter specification

This is the engineering specification for the `PropertyWriter` object.

## Overview

A `PropertyWriter` subscribes to streams and writes their values to properties.

## MVP

### Expose a concrete PropertyWriter class

```swift
public class PropertyWriter {
}
```

### Expose write API

This API should accept a `MotionObservable<T>` and a similarly-typed property.

The property writer should subscribe to the stream and write its `next` channel output to the
property.

The property writer should store the subscription in a collection of subscriptions.

```swift
class PropertyWriter {
  func write<T>(stream: MotionObservable<T>, to property: ScopedProperty<T>) {
```

Platforms without named arguments may call this API `writeTo`.
