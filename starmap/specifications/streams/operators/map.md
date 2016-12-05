---
layout: page
title: _map
status:
  date: December 4, 2016
  is: Draft
knowledgelevel: L3
library: streams
depends_on:
  - /starmap/specifications/streams/operators/operator
---

# _map specification

This is the engineering specification for the `MotionObservable` operator: `_map`.

## Overview

`_map` transforms an incoming value of type `T` to a new value of type `U`.

[ReactiveX documentation](http://reactivex.io/documentation/operators/map.html).

Example usage:

```swift
some$._map { point in return point.x }
```

## MVP

### Expose _map API

Should delegate to [`_operator`](operator).

```swift
public func _map<U>(_ transform: (T) -> U) -> MotionObservable<U> {
  return _operator { observer, value in
    observer.next(transform(value))
  }
}
```

If `OP` is available then this method should also accept an OP.

```swift
public func _map<U>(_ op: OP, _ transform: (T) -> U) -> MotionObservable<U> {
  return _operator(op) { observer, value in
    observer.next(transform(value))
  }
}
```
