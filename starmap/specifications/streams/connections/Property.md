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
public class ScopedProperty<T>: ScopedReadable<T>, ScopedWriteable<T> {
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
public class UnscopedProperty<O, T>: ScopedReadable<O, T>, ScopedWriteable<O, T> {
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
