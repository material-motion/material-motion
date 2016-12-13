---
layout: page
title: MotionAggregator
status:
  date: December 4, 2016
  is: Draft
knowledgelevel: L3
library: streams
depends_on:
  - /starmap/specifications/streams/MotionObservable
---

# MotionAggregator specification

This is the engineering specification for the `MotionAggregator` object.

## Overview

A `MotionAggregator` can subscribe to streams and emit aggregate events when the overall activity
of all streams changes.

## MVP

### Expose a concrete MotionAggregator class

```swift
public class MotionAggregator {
}
```

### Expose a write API

This APIs should accept a `MotionObservable<T>`.

The implementation should subscribe to the stream and hold on to its subscription internally.

```swift
class MotionAggregator {
  public func write<T>(_ stream: MotionObservable<T>, to property: ScopedWritable<T>)
```

### next channel implementation

The stream subscription should write all `next` values to the property.

```swift
class MotionAggregator {
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
class MotionAggregator {
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

### Expose state API

Expose an API that represents the aggregate state of all streams.

If any stream is active, then the aggregate state is active. If all streams are at rest, then
the aggregate is at rest.

```swift
class MotionAggregator {
  public var aggregateState = MotionState.atRest
```
