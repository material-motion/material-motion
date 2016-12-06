---
layout: page
title: Property
status:
  date: December 4, 2016
  is: Draft
knowledgelevel: L3
library: streams
depends_on:
  - /starmap/specifications/streams/connections/Getter
  - /starmap/specifications/streams/connections/Setter
---

# Property specification

This is the engineering specification for the `Property` object type.

## Overview

`Property` provides an abstraction for reading to and writing from a typed value.

## MVP

### Expose a Property API

`Property` is an instance that conforms to `Readable` and `Writeable`.

```swift
public class Property<T>: Readable, Writeable {
  public typealias Read = () -> T
  public typealias Write = (T) -> Void
}
```

### Expose initialization API

`Property` is an instance that conforms to `Readable` and `Writeable`.

```swift
public class Property<T>: Readable, Writeable {
  public let getter: Getter<T>
  public let setter: Setter<T>

  public init(get: @escaping Read, set: @escaping Write) {
    self.name = nil
    self.object = nil
    self.getter = Getter(get)
    self.setter = Setter(set)
  }
}
```

### Expose get/set APIs

```swift
  public var get: () -> T {
    return getter.get
  }

  public let set: (T) -> Void {
    setter.set(value)
  }
```
