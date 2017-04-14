---
layout: page
title: MotionRuntime.visualizationElement
status:
  date: April 14, 2017
  is: Proposed
interfacelevel: L1
implementationlevel: L4
library: material-motion
depends_on:
  - /starmap/specifications/runtime/
proposals:
  - proposal:
    initiation_date: April 14, 2017
    state: Draft
    discussion: "Introduced spec."
availability:
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/MotionRuntime.swift
---

# MotionRuntime.visualizationElement specification

This is the engineering specification for the `MotionRuntime`'s `visualizationElement` API.

## Overview

It's often helpful to be able to visualize changes as they're propagated. The `log` operator makes it easy to log stream output to the console. The `visualizationElement` API provides an element that can be provided to the `visualize(in: Element)` operator.

## MVP

### Lazily create the visualization element and store it on the runtime

This element should be added to the runtime's container element. This element should be stored on the runtime.

```swift
class MotionRuntime {
  func visualize(_ labelText: String? = nil, stream: MotionObservable) {
    if !visualizationElement {
      // Create and add visualizationElement
    }
  }
}
```

### Remove the visualization element when the runtime terminates

Ensure that you remove the visualization element when the runtime terminates.
