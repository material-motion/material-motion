---
layout: page
title: Property
status:
  date: December 6, 2016
  is: Draft
knowledgelevel: L3
library: streams
depends_on:
  - /starmap/specifications/streams/connections/Readable
  - /starmap/specifications/streams/connections/Writeable
---

# Property specification

This is the engineering specification for the `Property` concrete type.

## Overview

`Property` defines an interface for reading a value from - and writing a value to - a target object.

## MVP

### Option 1: Expose a concrete ScopedProperty API

```swift
public class ScopedProperty<V>: ScopedReadable<V>, ScopedWriteable<V> {
  public typealias Read = () -> V
  public typealias Write = (V) -> Void

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
public class UnscopedProperty<O, V>: ScopedReadable<O, V>, ScopedWriteable<O, V> {
  public typealias Read = (O) -> V
  public typealias Write = (O, V) -> Void

  public let read: Read
  public let write: Write

  public init(read: Read, write: Write) {
    self.read = read
    self.write = write
  }
}
```
