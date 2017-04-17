---
layout: page
title: MotionRuntime.get
status:
  date: April 17, 2017
  is: Proposed
interfacelevel: L1
implementationlevel: L4
library: material-motion
depends_on:
  - /starmap/specifications/runtime/
proposals:
  - proposal:
    completion_date: April 17, 2017
    state: Stable
    discussion: "Introduced proposal."
availability:
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/MotionRuntime.swift
---

# MotionRuntime.get specification

This is the engineering specification for the `MotionRuntime`'s `get` API.

## Overview

Reactive properties are often a representation of existing information in an application. For a given element, we might have a reactive property representation of its position, opacity, and background color.

Our goal is to ensure that element reactive properties are easy to access and reuse in order to reduce the likelihood of multiple reactive properties existing for the same element's information.

This spec proposes an API, `runtime.get(object)`, by which a **reactive instance** of an object can be returned. A reactive instance is a representation of an object where all properties are cached reactive property instances.

```swift
let reactiveView = runtime.get(view)

// Changing the reactive property
reactiveView.position.value = .init(x: 50, y: 100)

// Connecting one view's position to another
runtime.connect(reactiveView.position, to: runtime.get(otherView).position)
```

## MVP

### Expose a get API

Accept an object and return a reactive version of that object. This will require building reactive variants of supported types.

```swift
class MotionRuntime {
  public func get(view: UIView) -> ReactiveUIView
}
```

### Always return the same reactive instance for a given object

Cache and return the same reactive instance.
