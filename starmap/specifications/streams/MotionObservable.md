---
layout: page
title: MotionObservable
status:
  date: December 4, 2016
  is: Draft
knowledgelevel: L4
---

# MotionObservable specification

This is the engineering specification for the `MotionObservable` object.

## Overview

`MotionObservable` has a similar shape to [`IndefiniteObservable`](IndefiniteObservable), but with
the addition of `active` to the `Observer` type.

## MVP

### Fork the IndefiniteObservable implementation

Fork the `IndefiniteObservable` implementation.

**Do not depend on `IndefiniteObservable`.** `IndefiniteObservable` and `MotionObservable` are
incompatible types.

Replace all API references of Indefinite with Motion:

- `IndefiniteObservable -> MotionObservable`
- `Observer -> MotionObserver`
- `MotionSubscription -> MotionSubscription`
- `AnyObserver -> AnyMotionObserver`
- `SimpleSubscription -> SimpleMotionSubscription`

### Add active to the MotionObserver API

The method signature for active should accept a `Bool` and return nothing:

```swift
var active: (Bool) -> Void { get }
```

What the `MotionObserver` should look like:

```swift
public protocol MotionObserver {
  associatedtype Value
  var next: (Value) -> Void { get }
  var active: (Bool) -> Void { get }
}
```

### Add active to the AnyMotionObserver API

What the `AnyMotionObserver` should look like:

```swift
public final class AnyMotionObserver<T>: MotionObserver {
  public typealias Value = T

  public init(_ next: @escaping (T) -> Void, active: @escaping (Bool) -> Void) {
    self.next = next
    self.active = active
  }

  public let next: (T) -> Void
  public let active: (Bool) -> Void
}
```
