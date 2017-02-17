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

This is the engineering specification for the `OperatorMetadata` object.

## Overview

In order provide introspection capabilities, each observable is expected to store a small amount of
meta information about itself. This information is stored in an object called `Metadata`.

## MVP

Provide an `Metadata` type that represents metadata about the operator.

### Class type

Define a public object type named `OperatorMetadata`.

```swift
public class Metadata {
}
```

### Expose a metadata API on each MotionObservable

```swift
class MotionObservable {
  public const var metadata: Metadata
}
```

### Store name and args

```swift
class Metadata {
  public const var name: String
  public const var args: [Any]?
  private var parent: OperatorMetadata?

  private init(_ name: String, args: [Any]?, parent: OperatorMetadata?) {
    self.name = name
    self.args = args
    self.parent = parent
  }
```

### Expose with API

Expose a `with` method that creates a new OperatorMetadata with self as its parent.

```swift
class Metadata {
  public func with(_ name: String, args: [Any]? = nil) -> OperatorMetadata {
    return .init(name, args: args, parent: self)
  }
```

### Expose debug description API

Expose a debug description method. The implementation should traverse the parent Metadata and
construct a string represenation of the operator.

```swift
class Metadata {
  public var debugDescription: String {
  }
```

Example stream:

```swift
const var stream = gestureSource(pan)
  .state(is: .ended)
  .velocity(in: view)
  .y()
propertyWriter.write(stream, to: spring$.initialVelocity)
```

Example output (iOS):

```swift
drag(: UIPanGestureRecognizer::ObjectIdentifier(0x00007ff41321bdd0))
  .state(is: .ended)
  .velocity(in: UIView::ObjectIdentifier(0x00007ff41321ba90))
  .y()
  .writeTo(initialVelocity, of: SpringTo<CGFloat>::ObjectIdentifier(0x0000600000666800))
```

[View the issue tracking formalization of the debug description](https://github.com/material-motion/starmap/issues/90).
