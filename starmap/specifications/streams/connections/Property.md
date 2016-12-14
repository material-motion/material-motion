---
layout: page
title: Property
status:
  date: December 6, 2016
  is: Draft
knowledgelevel: L2
library: streams
depends_on:
  - /starmap/specifications/streams/connections/Readable
  - /starmap/specifications/streams/connections/Writable
availability:
  - platform:
    name: Android
    label: "streams-android in develop"
    url: https://github.com/material-motion/streams-android
  - platform:
    name: iOS
    label: "streams-swift in develop"
    url: https://github.com/material-motion/streams-swift
---

# Property specification

This is the engineering specification for the `Property` concrete type.

## Overview

`Property` defines an interface for reading a value from - and writing a value to - a target object.

## MVP

### Option 1: Expose a concrete ScopedProperty API

```swift
public class ScopedProperty<T>: ScopedReadable<T>, ScopedWritable<T> {
  public typealias Read = () -> T
  public typealias Write = (T) -> Void

  public let read: Read
  public let write: Write

  public init(read: Read, write: Write) {
    self.read = read
    self.write = write
  }
}
```

### Option 2: Expose a concrete UnscopedProperty API

```swift
public class UnscopedProperty<O, T>: UnscopedReadable<O, T>, UnscopedWritable<O, T> {
  public typealias Read = (O) -> T
  public typealias Write = (O, T) -> Void

  public let read: Read
  public let write: Write

  public init(read: Read, write: Write) {
    self.read = read
    self.write = write
  }
}
```
