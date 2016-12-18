---
layout: page
title: springSource dynamic destination
status:
  date: December 13, 2016
  is: Draft
knowledgelevel: L2
library: springs
depends_on:
  - /starmap/specifications/streams/sources/SpringSource-inline-implementation
  - /starmap/specifications/streams/connections/ReactiveProperty-observation
---

# springSource dynamic destination feature specification

This is the engineering specification for dynamic destinations on the `springSource` API.

## Overview

When the destination of a Spring changes, all active subscriptions should update their in-flight
spring simulations to the new destination. This is implemented using property observation.

Example:

```swift
let destination = propertyOf(view).center

let spring = Spring(to: destination, ...)
aggregator.write(springSource(spring), to: propertyOf(view).position)

let didTapStream = gestureSource(tap).onRecognitionState(.recognized)
aggregator.write(didTapStream.location(in: view), to: destination)
```

## MVP

### Subscribe to destination

Update the spring system's destination and unpause the animation in case it had already settled.

Unsubscribe the destination subscription when the spring is unsubscribed.

```swift
func springSource(spring: Spring) -> MotionObservable<Float> {
  return MotionObservable { observer in
    ...

    let destinationSubscription = spring.destination.addObserver { destination in
      springSystem.toValue = destination
      springSystem.isPaused = false
    }
    
    return {
      ...
      destinationSubscription.unsubscribe()
    }
```
