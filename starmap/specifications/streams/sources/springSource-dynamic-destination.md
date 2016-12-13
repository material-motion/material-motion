---
layout: page
title: springSource dynamic destination
status:
  date: December 13, 2016
  is: Draft
knowledgelevel: L2
library: springs
depends_on:
  - /starmap/specifications/streams/MotionObservable/
  - /starmap/specifications/streams/connections/Property-observation
---

# springSource dynamic destination feature specification

This is the engineering specification for dynamic destinations on the `springSource` API.

## Overview

When the destination of a Spring changes, all active subscriptions should update their in-flight
spring simulations to the new destination. This is implemented using [property observation](/starmap/specifications/streams/connections/Property-observation).

Example:

```swift
let destination = Property(...)
let spring = Spring(to: destination, ...)
let spring$ = springSource(spring)
aggregator.write(spring$, to: propertyOf(view).position)

// On tap, change the destination of the spring.
aggregator.write(gestureSource(tap).onRecognitionState(.recognized).location(in: view),
                 to: destination)
```

## MVP

### Subscribe to destination

Update the spring system's destination and unpause the animation in case it had already settled.

Unsubscribe the destination subscription when the spring is unsubscribed.

```swift
func springSource(spring: Spring) -> MotionObservable<Float> {
  return MotionObservable { observer in
    ...

    let destinationSubscription = spring.destination.subscribe { destination in
      springSystem.toValue = destination
      springSystem.isPaused = false
    }
    
    return {
      ...
      destinationSubscription.unsubscribe()
    }
```
