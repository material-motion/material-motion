---
layout: page
title: MotionRuntime.whenAllAtRest
status:
  date: April 18, 2017
  is: Proposed
interfacelevel: L1
implementationlevel: L4
library: material-motion
depends_on:
  - /starmap/specifications/observable/MotionObservable-Metadata
  - /starmap/specifications/runtime/
proposals:
  - proposal:
    initiation_date: April 18, 2017
    state: Stable
    discussion: "Introduced proposal."
availability:
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/MotionRuntime.swift
---

# MotionRuntime.whenAllAtRest specification

This is the engineering specification for the `MotionRuntime`'s `whenAllAtRest` API.

## Overview

whenAllAtRest invokes a callback once all of the provided `Stateful` interactions have come to rest.

If the provided list of interactions is empty, then the callback is invoked exactly once and immediately.

If all of the interactions are at rest then the callback is invoked before returning.

## MVP

### Expose a whenAllAtRest API

Accept an array of `Stateful` interactions and a callback function.

```swift
class MotionRuntime {
  public func whenAllAtRest(_ interactions: [Stateful], body: () -> Void)
}
```

### When no interactions are provided, invoke the callback immediately

```swift
func whenAllAtRest(_ interactions: [Stateful], body: () -> Void) {
  guard interactions.count > 0 else {
    body()
    return
  }
}
```

### If all interactions are at rest, immediately invoke the callback

### When the last active interaction comes to rest, invoke the callback
