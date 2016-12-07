---
layout: page
title: Readable
status:
  date: December 6, 2016
  is: Draft
knowledgelevel: L3
library: streams
depends_on:
  - /starmap/specifications/streams/connections/
---

# Readable specification

This is the engineering specification for the `Readable` abstract types.

## Overview

`Readable` defines an interface for reading a value from a target object.

## MVP

### Option 1: Expose ScopedReadable API

```swift
public protocol ScopedReadable<V> {
  func read() -> V
}
```

### Option 2: Expose UnscopedReadable API

```swift
public protocol UnscopedReadable<O, V> {
  func read(object: O) -> V
}
```
