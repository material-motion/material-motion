---
layout: page
title: _operator
status:
  date: December 4, 2016
  is: Draft
knowledgelevel: L3
library: streams
depends_on:
  - /starmap/specifications/streams/MotionObservable
---

# _operator specification

This is the engineering specification for the `MotionObservable` operator: `_operator`.

## Overview

`_operator` is a means by which new operators can be created.

Example usage:

```swift
public func _map<U>(_ transform: (T) -> U) -> MotionObservable<U> {
  return _operator { observer, value in
    observer.next(transform(value))
  }
}
```

## MVP

### Expose _operator API

```swift
public func _operator<U>(_ work: (AnyMotionObserver<U>, T) -> Void) -> MotionObservable<U> {
  return MotionObservable<U>({ observer in
    return self.subscribe(next: { value in
      work(observer, value)
    }, active: observer.active).unsubscribe
  }
}
```

If `OP` is available then this method should set up the hierarchical relationship between self
and the newly-created operator:

```swift
public func _operator<U>(_ op: OP, _ work: (AnyMotionObserver<U>, T) -> Void) -> MotionObservable<U> {
  return MotionObservable<U>(self.op.with(op.name, args: op.args)) { observer in
    return self.subscribe(next: { value in
      work(observer, value)
    }, active: observer.active).unsubscribe
  }
}
```
