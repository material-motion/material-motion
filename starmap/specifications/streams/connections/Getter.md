---
layout: page
title: Getter
status:
  date: December 4, 2016
  is: Draft
knowledgelevel: L3
library: streams
depends_on:
  - /starmap/specifications/streams/connections/
---

# Getter specification

This is the engineering specification for the `Getter` object type.

## Overview

`Getter` provides an abstraction for reading a typed value.

Example usage in Swift:

```swift
// Reading a constant
let getter = Getter<Int>(10)
print(getter.get()) // 10
```

```swift
// Reading a variable
var someVariable = 10
let getter = Getter<Int>({ return someVariable })
print(getter.get()) // 10
var someVariable = 5
print(getter.get()) // 5
```

## MVP

### Expose a Readable API

Expose a protocol: `Readable`.

```swift
public protocol Readable {
  associatedtype T
  typealias Read = () -> T

  readonly var get: Read
}
```

### Expose a Getter API

`Getter` is an instance that represents a readable typed value.

```swift
public class Getter<T>: Readable {
  public typealias Read = () -> T
  public let get: Read

  public init(_ get: Read) {
    self.get = get
  }

  public init(_ get: T) {
    self.get = { get }
  }
}
```
