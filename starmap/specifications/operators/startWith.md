---
layout: page
title: startWith
status:
  date: March 29, 2017
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: material-motion
depends_on:
  - /starmap/specifications/observable/MotionObservable
proposals:
  - proposal:
    completion_date: March 29, 2017
    state: Stable
    discussion: "First introduced"
interaction:
  inputs:
    - input:
      name: upstream
      type: T
    - input:
      name: initialValue
      type: T
  outputs:
    - output:
      name: downstream
      type: T
---

# startWith specification

This is the engineering specification for the `MotionObservable` operator: `startWith`.

## Overview

`startWith` emits the provided value and then subscribes upstream and emits all subsequent values
with no modification.

## Example usage

```swift
stream.startWith(0)

upstream  |  downstream
          |  0
20        |  20
80        |  80
```

## MVP

### Expose a startWith operator API

```swift
class MotionObservable<T> {
  public func startWith(initialValue: T) -> MotionObservable<T> 
}
```

### Create a MotionObservable that emits the initialValue on subscription

```swift
class MotionObservable<T> {
  public func startWith(initialValue: T) -> MotionObservable<T> {
    return MotionObservable { observer in
      observer.next(initialValue)
      let subscription = self.subscribeAndForward(to: observer)
      return {
        subscription.unsubscribe()
      }
    }
  }
}
```
