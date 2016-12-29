---
layout: page
title: MotionRuntime
status:
  date: December 4, 2016
  is: Draft
knowledgelevel: L3
library: streams
depends_on:
  - /starmap/specifications/streams/MotionObservable
availability:
  - platform:
    name: Android 
    url: https://github.com/material-motion/streams-android/blob/develop/library/src/main/java/com/google/android/material/motion/streams/MotionRuntime.java
  - platform:
    name: iOS
    url: https://github.com/material-motion/streams-swift/blob/develop/src/MotionRuntime.swift
---

# MotionRuntime specification

This is the engineering specification for the `MotionRuntime` object.

## Overview

A `MotionRuntime` can subscribe to streams and write their output to properties. All stream state
changes will be collected in aggregate and reported as a single aggregate state value.

## MVP

### Expose a concrete MotionRuntime class

```swift
public class MotionRuntime {
}
```

### Expose a write API

This APIs should accept a `MotionObservable<T>`.

The implementation should subscribe to the stream and hold on to its subscription internally.

```swift
class MotionRuntime {
  public func write<T>(_ stream: MotionObservable<T>, to property: ScopedWritable<T>)
```

### next channel implementation

The stream subscription should write all `next` values to the property.

```swift
class MotionRuntime {
  public func write<T>(_ stream: MotionObservable<T>, to property: ScopedWritable<T>) {
    subscriptions.append(stream.subscribe(next: {
      property.write($0)
    } ...
  }
```

### state channel implementation

The stream subscription should observe state changes in aggregate.

The implementation should handle multiple equivalent state values being received in sequence.
Consider using an incrementing integer as a unique identifier for each subscribed stream.

```swift
class MotionRuntime {
  public func write<T>(_ stream: MotionObservable<T>, to property: ScopedWritable<T>) {
    subscriptions.append(stream.subscribe(next: {
      ...

    }, state: { state in
      if state == .active {
        self.activeSubscriptions.insert(uniqueIdentifier)
      } else {
        self.activeSubscriptions.remove(uniqueIdentifier)
      }

      let oldState = strongSelf.state.read()
      let newState: MotionState = self.activeSubscriptions.count > 0 ? .active : .atRest
      if oldState != newState {
        self.state.write(newState)
      }
    }))
  }
```

### Expose reactive state API

Expose a ReactiveProperty `state` API that represents the aggregate state of all streams.

If any stream is active, then the aggregate state is active. If all streams are at rest, then
the aggregate is at rest.

```swift
class MotionRuntime {
  public const var state = createProperty(MotionState.atRest)
```
