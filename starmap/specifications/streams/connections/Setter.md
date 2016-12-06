---
layout: page
title: Setter
status:
  date: December 6, 2016
  is: Draft
knowledgelevel: L3
library: streams
depends_on:
  - /starmap/specifications/streams/connections/
---

# Setter specification

This is the engineering specification for the `Setter` object type.

## Overview

`Setter` provides an abstraction for writing to a typed value.

Example usage in Swift:

```swift
var someVariable = 10
let setter = Setter<Int>({ someVariable = $0 })
setter.set(5)
print(someVariable) // 5
```

## MVP

### Expose a Writeable API

Expose a protocol: `Writeable`.

```swift
public protocol Writeable {
  associatedtype T

  readonly var set: (T) -> Void
}
```

### Expose a Setter API

`Setter` is an instance that represents a writeable typed value.

```swift
public class Setter<T>: Writeable {
  public typealias Write = (T) -> Void
  public let set: Write

  public init(_ set: Write) {
    self.set = set
  }
}
```
