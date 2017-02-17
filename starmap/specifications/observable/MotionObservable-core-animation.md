---
layout: page
status:
  date: December 27, 2016
  is: Draft
knowledgelevel: L2
library: streams
depends_on:
  - /starmap/specifications/observable/MotionObservable/
---

# MotionObservable Core Animation feature specification

This is the engineering specification for `MotionObservable` support for Core Animation.

**This feature specification is targeted to the iOS platform alone**.

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

[Learn more about Core Animation](http://devstreaming.apple.com/videos/wwdc/2014/419xxli6f60a6bs/419/419_advanced_graphics_and_animation_performance.pdf).

### Why don't we emit the animation object on the next channel?

So that we may maximize interoperability with existing operators and interactions.

If we emitted a different `T` value for Core Animation-based streams then we'd have to introduce a
new class of operators, interactions, and properties that support these distinct `T` types. While
this would be more type safe, it would increase the burden on the L2 engineer. Rather than simply
choose which animation system to use (POP, Core Animation, etc...), the L2 engineer would also have
to rewrite all related code to handle the distinct types.

This spec has decided to lean towards improving the quality of life for an L2 engineer at the cost
of increased complexity in the MotionObservable implementation.

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

Add must accept a property animation, a key, a model value, and an optional initial velocity. Remove
must accept a key.

```swift
enum CoreAnimationChannelEvent {
  case add(CAPropertyAnimation, String, modelValue: Any, initialVelocity: Any?)
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
