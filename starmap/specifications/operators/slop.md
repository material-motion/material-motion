---
layout: page
title: slop
status:
  date: February 21, 2016
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: reactive-motion
depends_on:
  - /starmap/specifications/observable/MotionObservable
  - /starmap/specifications/operators/dedupe
  - /starmap/specifications/operators/thresholdRange
interaction:
  inputs:
    - input:
      name: upstream
      type: number
    - input:
      name: size
      type: number
  outputs:
    - output:
      name: downstream
      type: SlopEvent
---

# slop specification

This is the engineering specification for the `MotionObservable` operator: `slop`.

## Overview

`slop` emits events in reaction to exiting and re-entering a slop region.

The slop region is centered around 0 and has a given size. This operator will not emit any
events until the upstream value exits this slop region, at which point `onExit` will be emitted. If
the upstream returns to the slop region then `onReturn` will be emitted.

## Example usage

```swift
stream.slop(size: 50)

upstream size  |  downstream
20       50    |
10       50    |
60       50    |  .onExit
70       50    |
10       50    |  .onReturn
20       50    |
80       50    |  .onExit
```

## MVP

### Define a SlopEvent type

```swift
public enum SlopEvent {
  case onExit
  case onReturn
}
```

### Expose a slop operator API

Accept a single argument defining the size of the slop region, centered around 0.

```swift
class MotionObservable<number> {
  public func slop(size: number) -> MotionObservable<SlopEvent>
```

### Create a Boolean reactive property

Initialize it with false. This property will track whether the upstream has left the slop region.

```swift
class MotionObservable<number> {
  func slop(size: number) -> MotionObservable<SlopEvent> {
    let didLeaveSlopRegion = createProperty(withInitialValue: false)
```

### Subscribe upstream and enable didLeaveSlopRegion upon leaving the slop

```swift
class MotionObservable<number> {
  func slop(size: number) -> MotionObservable<SlopEvent> {
    ...
    
    return MotionObservable { observer in
      let upstreamSubscription = self
        .thresholdRange(min: -size, max: size)
        .rewrite([.whenBelow: true, .whenAbove: true])
        .dedupe()
        .subscribe { didLeaveSlopRegion.value = $0 }

      ...
```

### Subscribe upstream and valve it based on didLeaveSlopRegion

```swift
class MotionObservable<number> {
  func slop(size: number) -> MotionObservable<SlopEvent> {
    ...
    
    return MotionObservable { observer in
      ...

      let downstreamSubscription = self
        .valve(openWhenTrue: didLeaveSlopRegion)
        .thresholdRange(min: -size, max: size)
        .rewrite([.whenBelow: .onExit, .whenWithin: .onReturn, .whenAbove: .onExit])
        .dedupe()
        .subscribe(observer: observer)

      ...
```
