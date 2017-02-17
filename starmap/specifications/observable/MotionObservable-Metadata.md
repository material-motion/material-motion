---
layout: page
title: Metadata
status:
  date: December 4, 2016
  is: Draft
knowledgelevel: L4
library: reactive-motion
depends_on:
  - /starmap/specifications/observable/MotionObservable
---

# Metadata feature specification for MotionObservable

This is the engineering specification for the `Metadata` object.

## Overview

In order provide introspection capabilities, each `MotionObservable` instance is expected to store a
small amount of meta information about itself. This information is stored in an object called
`Metadata`.

## MVP

### Expose a Metadata type

Expose a public class type named `Metadata`.

```swift
public class Metadata {
}
```

### Store name, uuid, and args

```swift
class Metadata {
  public const var identifier: String
  public const var label: String
  public const var args: [Any]?
  private var parent: OperatorMetadata?

  init(_ identifier: String, objectIdentifier: String? args: [Any]?, parent: Metadata?) {
    if let objectIdentifier = objectIdentifier {
      self.identifier = objectIdentifier + identifier
    } else {
      self.identifier = identifier
    }
    self.label = identifier
    self.args = args
    self.parent = parent
  }
```

### Expose with API

Expose a `with` method that creates a new OperatorMetadata with self as its parent.

```swift
class Metadata {
  public func with(_ name: String, args: [Any]? = nil) -> Metadata {
    return .init(name, args: args, parent: self)
  }
```

### Expose debug description API

Expose a debug description method. The output is expected to be a recursive representation of this
metadata and all of its ancestral metadata.

```swift
class Metadata {
  public var debugDescription: String {
  }
```

[View the issue tracking formalization of the debug description](https://github.com/material-motion/starmap/issues/90).

### Store a constant metadata instance on each MotionObservable

```swift
class MotionObservable {
  public const var metadata: Metadata
}
```
