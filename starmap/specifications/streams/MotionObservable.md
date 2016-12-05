---
layout: page
title: MotionObservable
status:
  date: December 4, 2016
  is: Draft
knowledgelevel: L4
library: streams
---

# MotionObservable specification

This is the engineering specification for the `MotionObservable` object.

## Overview

`MotionObservable` has a similar shape to [`IndefiniteObservable`](IndefiniteObservable), but with
the addition of `active` to the `Observer` type.

## MVP

### Fork the IndefiniteObservable implementation

Fork the `IndefiniteObservable` implementation.

**Do not depend on or subclass `IndefiniteObservable`.** `IndefiniteObservable` and
`MotionObservable` are incompatible types.

Replace all API references of Indefinite/Next with Motion:

- `IndefiniteObservable -> MotionObservable`
- `NextObserver -> MotionObserver`

### Add active to the MotionObserver API

What the `AnyMotionObserver` should look like:

```swift
public final class MotionObserver<T>: MotionObserver {
  public typealias Value = T

  public init(_ next: @escaping (T) -> Void, active: @escaping (Bool) -> Void) {
    self.next = next
    self.active = active
  }

  public let next: (T) -> Void
  public let active: (Bool) -> Void
}
```
