---
layout: page
permalink: /starmap/specifications/streams/Property/
title: Property
status:
  date: December 4, 2016
  is: Draft
knowledgelevel: L3
library: streams
---

# Property specification

This is the engineering specification for the `Property` object type.

## Overview

A `Property` provides a serializable read/write abstraction for a given object.

Example usage in Swift:

```swift
let property = Property<UIView, CGPoint>("center",
                                         read: { object in object.center },
                                         write: { object, value in object.center = value })
var center = property.read(view)
center.x = 10
property.write(view, center)
```

## MVP

### Generic type

A `Property` is typed with two generic types: `O` and `T`. `O` is the object type and `T` is the
value type.

### Property object type

`Property` is a class with two generic types: `O` and `T`.

```swift
public class Property<O, T> {
}
```

### Read/write types

```swift
public typealias Read = (O) -> T
public typealias Write = (O, T) -> Void
```

### Initialized with read/write functions and a name

```swift
public class Property<O, T> {
  public let name: String
  public let read: Read
  public let write: Write

  init(_ name: String, read: Read, write: Write) {
    self.name = name
    self.read = read
    self.write = write
  }
}
```
