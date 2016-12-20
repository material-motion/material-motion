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

The implementation should handle multiple equivalent state values being received in sequence; i.e.
a simple counter implementation in which .active is an increment and .atRest is a decrement will not
suffice without some form of deduping. A token implementation using uuids and a set is simple.

```swift
class MotionRuntime {
  public func write<T>(_ stream: MotionObservable<T>, to property: ScopedWritable<T>) {
    subscriptions.append(stream.subscribe(next: {
      ...

    }, state: { [weak self] state in
      guard let strongSelf = self else { return }
      if state == .active {
        strongSelf.activeSubscriptions.insert(token)
      } else {
        strongSelf.activeSubscriptions.remove(token)
      }

      strongSelf.aggregateState = strongSelf.activeSubscriptions.count > 0 ? .active : .atRest
    }))
  }
```

### Expose readonly state API

Expose a readonly API that represents the aggregate state of all streams.

If any stream is active, then the aggregate state is active. If all streams are at rest, then
the aggregate is at rest.

```swift
class MotionRuntime {
  public readonly var aggregateState = MotionState.atRest
```
