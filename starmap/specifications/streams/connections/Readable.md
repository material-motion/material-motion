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
related_to:
  - /starmap/specifications/streams/connections/Writable
---

# Readable specification

This is the engineering specification for the `Readable` abstract types.

## Overview

`Readable` defines an interface for reading a value from a target object.

## MVP

### Option 1: Expose an abstract ScopedReadable API

```swift
public protocol ScopedReadable<T> {
  func read() -> T
}
```

### Option 2: Expose an abstract UnscopedReadable API

```swift
public protocol UnscopedReadable<O, T> {
  func read(object: O) -> T
}
```
