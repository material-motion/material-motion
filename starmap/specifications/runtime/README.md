---
layout: page
title: MotionRuntime
permalink: /starmap/specifications/runtime/
status:
  date: February 20, 2017
  is: Stable
interfacelevel: L1
implementationlevel: L4
library: material-motion
depends_on:
  - /starmap/specifications/observable/MotionObservable
proposals:
  - proposal:
    completion_date: March 23, 2017
    state: Stable
    discussion: "runtime.add for streams changed to runtime.connect"
availability:
  - platform:
    name: Android 
    url: https://github.com/material-motion/material-motion-android/blob/develop/library/src/main/java/com/google/android/material/motion/MotionRuntime.java
  - platform:
    name: JavaScript
    url: https://github.com/material-motion/material-motion-js/blob/develop/packages/streams/src/MotionRuntime.ts
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/MotionRuntime.swift
---

# MotionRuntime specification

This is the engineering specification for the `MotionRuntime` object.

## Overview

A `MotionRuntime`'s primary responsibility is to write the output of streams to reactive properties.

> We use the terms *motion runtime* and *runtime* interchangeably throughout the starmap.

## MVP

### Expose a concrete MotionRuntime class

```swift
public class MotionRuntime {
}
```

### Expose a connect API

The implementation should subscribe to the stream and hold on to its subscription internally.

New values received from the subscribed stream should be written to the property.

```swift
class MotionRuntime {
  public func connect<T>(stream: MotionObservable<T>, to property: ReactiveProperty<T>)
}
```

### Create private storage for subscriptions

An array is adequate because we currently have no mechanism for removing subscriptions once they are
made.

```swift
class MotionRuntime {
  private var subscriptions: [Subscription] = []
}
```

### Store all subscriptions

An array is adequate because we currently have no mechanism for removing subscriptions once they are
made.

```swift
class MotionRuntime {
  func connect<T>(stream: MotionObservable<T>, to property: ReactiveProperty<T>) {
    subscriptions.append(stream.subscribe(next: { property.value = $0 }))
  }
}
```
