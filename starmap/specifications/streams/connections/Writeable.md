---
layout: page
title: Writeable
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

# Writeable specification

This is the engineering specification for the `Writeable` abstract types.

## Overview

`Writeable` defines an interface for writing a value to a target object.

## MVP

### Option 1: Expose an abstract Writable API

```swift
public protocol Writable<T> {
  func write(value: T)
}
```

### Option 2: Expose an abstract UnscopedWritable API

```swift
public protocol UnscopedWritable<O, T> {
  func write(object: O, value: T)
}
```
