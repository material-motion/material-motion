---
layout: page
title: MotionRuntime.visualize
status:
  date: April 14, 2017
  is: Proposed
interfacelevel: L1
implementationlevel: L4
library: material-motion
depends_on:
  - /starmap/specifications/runtime/
  - /starmap/specifications/operators/dedupe
  - /starmap/specifications/operators/toString
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

# MotionRuntime.visualize specification

This is the engineering specification for the `MotionRuntime`'s `visualize` API.

## Overview

It's often helpful to be able to visualize changes as they're propagated. The `log` operator makes it easy to log stream output to the console. `runtime.visualize` makes it easy to see stream output visually on the runtime's container element.

```swift
runtime.visualize { position }
```

With a prefix label:

```swift
runtime.visualize("Position: ") { position }
```

## MVP

### Expose a visualize API

Accept an optional string and a stream.

```swift
class MotionRuntime {
  public func visualize(_ labelText: String? = nil, stream: MotionObservable)
}
```

### Ensure a visualization element exists

Before creating the visualization label, ensure that a visualization element exists. This element should be added to the runtime's container element. This element should be stored on the runtime.

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

### Create a new label and add it to the visualization element

Create a new label each time and append it to the visualization element.

### Subscribe to the stream and write values to the label

Create a new label and subscribe to the stream, writing emitted values to the label as they're received. Flash the label with a background color in order to draw attention to the fact that the value changed.

```swift
class MotionRuntime {
  func visualize(_ labelText: String? = nil, stream: MotionObservable) {
    write(stream.toString().dedupe(), to: ReactiveProperty(initialValue: "", externalWrite: { value in
      label.text = (labelText ?? "") + value

      // Flash the element
      highlight.alpha = 1
      UIView.animate(withDuration: 0.3) {
        highlight.alpha = 0
      }
    }))
  }
}
```
