---
layout: page
title: TweenSource
status:
  date: December 20, 2016
  is: Draft
knowledgelevel: L2
library: tweens
depends_on:
  - /starmap/specifications/streams/MotionObservable/
  - /starmap/specifications/streams/plans/Tween
---

# TweenSource specification

This is the engineering specification for the `TweenSource` type.

## Overview

A `TweenSource` is a function that accepts a `Tween` of type `T` and returns a MotionObservable
capable of emitting `T` values.

Example usage:

```swift
TweenSource(tween).subscribe(...)
```

```java
TweenSource.from(tween).subscribe(...)
```

## MVP

### Expose a TweenSource type

`TweenSource` is a function signature. It accepts a Tween of type T and returns a MotionObservable
of the same type T.

```swift
public typealias TweenSource<T> = (Tween<T>) -> MotionObservable<T>
```
