---
layout: page
title: _filter
status:
  date: December 4, 2016
  is: Draft
knowledgelevel: L3
library: streams
depends_on:
  - /starmap/specifications/streams/operators/operator
---

# _filter specification

This is the engineering specification for the `MotionObservable` operator: `_filter`.

## Overview

`_filter` only forwards values that pass a test.

[ReactiveX documentation](http://reactivex.io/documentation/operators/filter.html).

Example usage:

```swift
some$._filter { state in return state == .began || state == .changed }
```

## MVP

### Expose _filter API

Should delegate to [`_operator`](operator).

```swift
public func _filter(_ passesTest: (T) -> Bool) -> MotionObservable<T> {
  return _operator { observer, value in
    if passesTest(value) {
      observer.next(value)
    }
  }
}
```

If `OP` is available then this method should also accept an OP.

```swift
public func _filter(_ op: OP, _ passesTest: (T) -> Bool) -> MotionObservable<T> {
  return _operator(op) { observer, value in
    if passesTest(value) {
      observer.next(value)
    }
  }
}
```
