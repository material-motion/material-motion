---
layout: page
status:
  date: December 27, 2016
  is: Draft
knowledgelevel: L2
library: streams
depends_on:
  - /starmap/specifications/streams/MotionObservable/
---

# MotionObservable Core Animation feature specification

This is the engineering specification for `MotionObservable` support for Core Animation.

## Overview

Core Animation makes use of what is called *the render server*. The render server is an iOS-wide
process for executing performant animations even if an application's main thread is busy.

This feature specification is targeted to the iOS platform alone.

[Learn more about Core Animation](http://devstreaming.apple.com/videos/wwdc/2014/419xxli6f60a6bs/419/419_advanced_graphics_and_animation_performance.pdf).

## MVP

### Expose a CoreAnimationChannelEvent enum

```swift
public enum CoreAnimationChannelEvent
```

### Define two events: add and remove

Add must accept a property animation and a key. Remove must accept a key.

```swift
enum CoreAnimationChannelEvent {
  case add(CAPropertyAnimation, String)
  case remove(String)
}
```

### Expose a CoreAnimationChannel type

This channel accepts a core animation channel event and returns nothing.

```swift
public typealias CoreAnimationChannel = (CoreAnimationChannelEvent) -> Void
```

### Add a coreAnimation channel to MotionObserver

Also require the channel in the observer initializer.

```swift
class MotionObserver {
  public const var coreAnimation: CoreAnimationChannel
```

### Store an optional core animation channel on ReactiveProperty

Provided via an initializer.

```swift
class ReactiveProperty {
  private const var _coreAnimation: CoreAnimationChannel?
```

### Expose a coreAnimation API on ReactiveProperty

The implementation should throw an assertion if no core animation channel was provided. Otherwise
it should invoke the provided core animation channel.

```swift
class ReactiveProperty {
  public func coreAnimation(_ event: CoreAnimationChannelEvent)
```

### Implement layer properties that support Core Animation

CALayer property implementations are expected to add animations to and remove animations from a
specific layer.
