---
layout: page
title: MotionObservable OP
status:
  date: December 4, 2016
  is: Draft
knowledgelevel: L4
library: streams
depends_on:
  - /starmap/specifications/streams/MotionObservable
---

# OP feature specification for MotionObservable

This is the engineering specification for the `OP` object.

## Overview

Observables can be referred to as operators. A series of operators is referred to a stream. In order
provide introspection capabilities, each operator is expected to store a small amount of meta
information about itself. This information is stored in an object called `OP`.

## MVP

Provide an `OP` type that represents metadata about the operator.

### Class type

Define a public object type named `OP`.

```swift
public class OP {
}
```

### Store name and args

```swift
class OP {
  public let name: String
  public let args: [Any]?
  private var parent: OP?

  private init(_ name: String, args: [Any]?, parent: OP?) {
    self.name = name
    self.args = args
    self.parent = parent
  }
```

### Expose with API

Expose a `with` method that creates a new OP with self as its parent.

```swift
class OP {
  public func with(_ name: String, args: [Any]? = nil) -> OP {
    return .init(name, args: args, parent: self)
  }
```

### Expose debug description API

Expose a debug description method. The implementation should traverse the parent OPs and construct
a string represenation of the operator.

```swift
class OP {
  public var debugDescription: String {
  }
```

Example stream:

```swift
drag(pan)
  .state(is: .ended)
  .velocity(in: view).y()
  .writeTo(spring$.initialVelocity, of: spring$)
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
