---
layout: page
title: Property
status:
  date: December 4, 2016
  is: Draft
knowledgelevel: L3
library: streams
depends_on:
  - /starmap/specifications/streams/properties/Property
---

# ReadonlyProperty feature specification

This is the engineering specification for the `ReadonlyProperty` object type.

## Overview

A `ReadonlyProperty` provides a read abstraction for a given object. Property must model both reads
and writes to a given target; ReadonlyProperty makes it possible to create properties for constant
types.

Example usage in Swift:

```swift
let property = ReadonlyProperty<Int, Int>("Int", read: { $0 })
print(property.read(10))
```

APIs that only need to read form a property can be made more flexible by requiring the
`ReadableProperty` type instead of `Property`.

```swift
func position<O, P: ReadableProperty>(source: O, property: P) -> CGPoint where O == P.O, P.T == CGPoint {
  let sourceValue: CGPoint = property.read(source)
  return sourceValue
}
```

## MVP

### Expose ReadableProperty and WriteableProperty APIs

Expose two new protocols: `ReadableProperty` and `WriteableProperty`.

```swift
public protocol ReadableProperty {
  associatedtype O
  associatedtype T
  typealias Read = (O) -> T

  var name: String { get }
  var read: Read { get }
}

public protocol WriteableProperty {
  associatedtype O
  associatedtype T
  typealias Write = (O, T) -> Void

  var name: String { get }
  var write: Write { get }
}
```

### Property now conforms to both ReadableProperty and WriteableProperty

```swift
public class Property<O, T>: ReadableProperty, WriteableProperty {
  public typealias Read = (O) -> T
  public typealias Write = (O, T) -> Void
```

### Expose a ReadonlyProperty API

A `ReadonlyProperty` is a property that can be read from but not written to.

```swift
public class ReadonlyProperty<O, T>: ReadableProperty {
  public typealias Read = (O) -> T

  public let name: String
  public let read: Read

  public init(_ name: String, read: @escaping Read) {
    self.name = name
    self.read = read
  }
}
```
