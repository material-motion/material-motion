---
layout: page
title: Tween
status:
  date: December 15, 2016
  is: Draft
knowledgelevel: L2
library: streams
---

# Tween specification

This is the engineering specification for the concrete `Tween` API.

## Overview

A Tween animates between a list of values using a pre-defined timing function.

Example usage:

```swift
const var view = UIView()
const var target = UIView()
const var tween = Tween(duration: 0.3, values: [0, 1])
const var tween$ = tweenSource(tween)
...
```

## MVP

### Expose Tween API

This class should be generic with a value `T`.

```swift
public final class Tween<T> {
```

### Expose property APIs

These properties should be provided at initialization time.

`duration` is the length of time over which the animation should occur, expressed in milliseconds (e.g. 300 milliseconds).

`delay` is the number of milliseconds that should elapse before a tween begins.

`values` is an array of objects that each define a single frame of the animation.

> If `values.length == 1` then the `values[0]` value is treated as the `destination` value of the property.

`offsets` optionally defines the pacing of the animation. Each offset corresponds to its identically-indexed value in the `values` array. Each offset is a floating point number in the range of `[0,1]` and is expected to be absolute and monotonically increasing. If not provided, each value is assumed to be evenly spaced.

`timingFunctions` optionally defines the timing functions to be used between any two values. If `values` is of length `n`, then `interTimingFunctions` should be of length `n-1`. If not provided, each timing function is assumed to be linear. If `values.length == 1` then `interTimingFunctions[0]` value is treated as the timing function for the animation.

```swift
class Tween {
  public var duration: TimeInterval
  public var delay: TimeInterval = 0
  public var values: [T]
  public var keyPositions: [Double]?
  public var timingFunctions: [CAMediaTimingFunction]?
```
