---
layout: page
title: valve
status:
  date: February 21, 2016
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: material-motion
depends_on:
  - /starmap/specifications/observable/MotionObservable
availability:
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/operators/valve.swift
interaction:
  inputs:
    - input:
      name: upstream
      type: T
    - input:
      name: stream
      type: "MotionObservable<Bool>"
  outputs:
    - output:
      name: downstream
      type: T
---

# valve specification

This is the engineering specification for the `MotionObservable` operator: `valve`.

## Overview

`valve` subscribes and emits values from upstream so long as the provided stream's last emitted
value was `true`.

## MVP

### Expose a valve operator API

Use `MotionObservable` to implement the operator. Accept a MotionObservable of type Bool.

```swift
class MotionObservable<T> {
  public func valve(openWhenTrue valveStream: MotionObservable<Bool>) -> MotionObservable<T>
```

### Create a nullable upstream subscription

```swift
class MotionObservable<T> {
  func valve(openWhenTrue valveStream: MotionObservable<Bool>) -> MotionObservable<T>
    return MotionObservable<T> { observer in
      var upstreamSubscription: Subscription?
      
      ...
    }
```

### Permanently subscribe to the valve stream

Toggle the upstream subscription based on the emitted value of the valve stream. Subscribe upstream
when true is received. Unsubscribe from the upstream when false is received.

```swift
class MotionObservable<T> {
  func valve(openWhenTrue valveStream: MotionObservable<Bool>) -> MotionObservable<T>
    return MotionObservable<T> { observer in
      ...

      let valveSubscription = stream.subscribe { value in
        let shouldOpen = value

        if shouldOpen && upstreamSubscription == nil {
          upstreamSubscription = self.subscribe(observer: observer)
        }

        if !shouldOpen && upstreamSubscription != nil {
          upstreamSubscription?.unsubscribe()
          upstreamSubscription = nil
        }
      }
      
    }
```

### Unsubscribe from all streams on disconnect

```swift
class MotionObservable<T> {
  func valve(openWhenTrue valveStream: MotionObservable<Bool>) -> MotionObservable<T>
    return MotionObservable<T> { observer in
      ...

      return {
        valveSubscription.unsubscribe()
        upstreamSubscription?.unsubscribe()
        upstreamSubscription = nil
      }
    }
```
