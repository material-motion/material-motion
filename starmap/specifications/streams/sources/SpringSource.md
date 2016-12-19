---
layout: page
title: SpringSource
status:
  date: December 13, 2016
  is: Draft
knowledgelevel: L2
library: springs
depends_on:
  - /starmap/specifications/streams/MotionObservable/
  - /starmap/specifications/streams/plans/Spring
---

# SpringSource specification

This is the engineering specification for the `SpringSource` type.

## Overview

A `SpringSource` is a function that accepts a `Spring` of type `T` and returns a MotionObservable
capable of emitting `T` values.

Example usage:

```swift
springSource(spring).subscribe(...)
```

```java
SpringSource.from(spring).subscribe(...)
```

## MVP

### Expose a SpringSource type

`SpringSource` is a function signature. It accepts a Spring of type T and returns a MotionObservable
of the same type T.

```swift
public typealias SpringSource<T> = (Spring<T>) -> MotionObservable<T>
```