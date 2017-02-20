---
layout: page
title: MotionRuntime
permalink: /starmap/specifications/runtime/
status:
  date: February 20, 2016
  is: Stable
knowledgelevel: L1
library: streams
depends_on:
  - /starmap/specifications/observable/MotionObservable
availability:
  - platform:
    name: Android 
    url: https://github.com/material-motion/reactive-motion-android/blob/develop/library/src/main/java/com/google/android/reactive/motion/MotionRuntime.java
  - platform:
    name: JavaScript
    url: https://github.com/material-motion/material-motion-js/blob/develop/packages/streams/src/MotionRuntime.ts
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/reactive-motion-swift/blob/develop/src/MotionRuntime.swift
---

# MotionRuntime specification

This is the engineering specification for the `MotionRuntime` object.

## Overview

A `MotionRuntime`'s primary responsibility is to write the output of streams to reactive properties.

We use the terms *motion runtime* and *runtime* interchangeably throughout the starmap.

Interactions can be added to a runtime. The runtime will ask the interaction to register streams or
other interactions. This is the mechanism by which the runtime enables composable interactions.

## MVP

### Expose a concrete MotionRuntime class

```swift
public class MotionRuntime {
}
```

### Expose an add API

The implementation should subscribe to the stream and hold on to its subscription internally.

New values received from the subscribed stream should be written to the property.

```swift
class MotionRuntime {
  public func add<T>(stream: MotionObservable<T>, to property: ReactiveProperty<T>)
```
