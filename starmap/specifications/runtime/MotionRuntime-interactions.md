---
layout: page
title: MotionRuntime.interactions
status:
  date: April 24, 2017
  is: Stable
interfacelevel: L1
implementationlevel: L4
library: material-motion
depends_on:
  - /starmap/specifications/runtime/
  - /starmap/specifications/interactions/
proposals:
  - proposal:
    completion_date: April 24, 2017
    state: Stable
    discussion: "Introduced spec."
availability:
  - platform:
    name: Android 
    url: https://github.com/material-motion/material-motion-android/blob/develop/library/src/main/java/com/google/android/material/motion/MotionRuntime.java
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/MotionRuntime.swift
---

# MotionRuntime.interactions specification

This is the engineering specification for the `MotionRuntime`'s `interactions` API.

## Overview

This API retrieves interactions of a specific type associated with a given target via the `.add` API.

```swift
let draggables = runtime.interactions(for: view) { $0 as? Draggable }
```

## MVP

### Expose an interactions API

The API should be generic on the Interaction type and accept a target and class.

```swift
class MotionRuntime {
  public func interactions<I>(for target: I.Target, filter: I) -> [I] where I: Interaction
}
```

### Cache interactions associated with targets in runtime.add

Each time an interaction is added to a target, cache that association in an internal map of targets to interactions.

### Return all interactions of the desired type for the given target.

Return the list of interactions matching the desired type that were associated with the given target.
