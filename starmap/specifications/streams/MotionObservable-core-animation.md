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
process for executing performant animations even if an application's main thread is busy. The render
server is a black box: once an animation object is added to it we can no longer augment that
animation's values or parameters. This design is distinct from other animation systems because we
can't apply stream operators to the animation as it progresses.

Core Animation uses **animation objects** to describe animations. These objects are much like our
Tween specification.

Instead of emitting values on the `next` channel with every animation frame, Core Animation streams
emit a single value on the `next` channel: **the layer model value**. Core Animation streams also
emit a keyed animation object on a new channel called the `coreAnimation` channel. This combination
of model value + core animation emitting provides the flexibility needed to create Core
Animation-backed animations that work in a platform-expected manner.

This feature specification is targeted to the iOS platform alone.

[Learn more about Core Animation](http://devstreaming.apple.com/videos/wwdc/2014/419xxli6f60a6bs/419/419_advanced_graphics_and_animation_performance.pdf).

## Examples

In the following example we create a point spring stream backed by Core Animation with a `x()`
operator applied to it.

```swift
let spring = Spring<CGPoint>(...)

let springStream = coreAnimationSpringSource(spring)

let xProperty = propertyOf(layer).positionX()
runtime.write(springStream.x(), to: xProperty)
```

We might similarly write the above code using a POP spring source:

```swift
let spring = Spring<CGPoint>(...)

let springStream = popSpringSource(spring)

let xProperty = propertyOf(layer).positionX()
runtime.write(springStream.x(), to: xProperty)
```

Note that the only thing we need to change is which source we're using.

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
