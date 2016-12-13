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

### Is a type of MotionObservable

```swift
public class MotionAggregator<T>: MotionObservable<T> {
}
```

### Initialized with an optional name

```swift
class MotionAggregator<T>: MotionObservable<T> {
  public let name: String?
  public init(named name: String? = nil)
```

### Subscriber implementation

The subscriber implementation should add and remove observers to a shared observers set.

Depending on your language you may need to create a local version of the variable first, assign it
to self, and then refer to the locally-scoped variable in the callback.

```swift
class MotionAggregator<T>: MotionObservable<T> {
  public init(named name: String? = nil) {
    self.name = name

    let observers = NSMutableSet()
    self.observers = observers
    super.init { observer in
      observers.add(observer)
      return {
        observers.remove(observer)
      }
    }
  }
```

### Expose Token type

Represents a globally unique value.

```
public typealias Token = String
```

### Expose register APIs

These APIs should accept `MotionObservable<T>` instances and return a unique Token instance for
each stream.

The aggregator should subscribe to each stream and hold on to its subscription internally.

Tokens do not need to be retained, unlike Subscriptions. Streams that are registered with an
aggregator remain subscribed until the aggregator is released.

```swift
class MotionAggregator<T>: MotionObservable<T> {
  public func register(_ streams: [MotionObservable<T>]) -> [Token]
  public func register(_ stream: MotionObservable<T>) -> Token
```

### Expose isActive API

Expose an API that represents whether the aggregate set of subscribed streams is active or not.

If any stream is active, then the aggregate is active. If no streams are active, then neither is the
aggregate.

```swift
class MotionAggregator<T>: MotionObservable<T> {
  public var isActive: Bool = false
```

### next internal API

Implement a function that retrieves a `next` method for use in an Observer.

```swift
class MotionAggregator<T>: MotionObservable<T> {
  private var next: (T) -> Void {
    return { [weak self] value in
      guard let strongSelf = self else { return }
      for observer in strongSelf.observers {
        (observer as! AnyMotionObserver<T>).next(value)
      }
    }
  }
```

### active internal API

Implement a function that retrieves an `active` method for use in an Observer.

The method should accept a token and return a function that adds/removes the token from an
`activeTokens` set. The aggregator's `active` state should then be updated.

```swift
class MotionAggregator<T>: MotionObservable<T> {
  private func active(_ token: Token) -> (Bool) -> Void {
    return { [weak self] in
      guard let strongSelf = self else { return }
      if $0 {
        strongSelf.activeTokens.insert(token)
      } else {
        strongSelf.activeTokens.remove(token)
      }
      strongSelf.active = strongSelf.activeTokens.count > 0
    }
  }
```

### Connection internal API

This method accepts a token. It subscribes to the token's stream and stores its subscription.

```swift
class MotionAggregator<T>: MotionObservable<T> {
  private func connect(token: Token) {
    let stream = streams[token]
    subscriptions[token] = stream.subscribe(next: next, active: active(token))
  }
```
