---
layout: page
title: Writable
status:
  date: December 6, 2016
  is: Draft
knowledgelevel: L3
library: streams
depends_on:
  - /starmap/specifications/streams/connections/
related_to:
  - /starmap/specifications/streams/connections/Readable
---

# Writable specification

This is the engineering specification for the `Writable` abstract types.

## Overview

`Writable` defines an interface for writing a value to a target object.

## MVP

### Option 1: Expose an abstract ScopedWritable API

```swift
public protocol ScopedWritable<T> {
  func write(value: T)
}
```

### Option 2: Expose an abstract UnscopedWritable API

```swift
public protocol UnscopedWritable<O, T> {
  func write(object: O, value: T)
}
```
