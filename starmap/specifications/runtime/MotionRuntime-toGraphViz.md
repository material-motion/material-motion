---
layout: page
title: MotionRuntime.toGraphViz
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

# MotionRuntime.toGraphViz specification

This is the engineering specification for the `MotionRuntime`'s `toGraphViz` API.

## Overview

toGraphViz generates a [graphviz](http://www.graphviz.org/) representation of a MotionRuntime's connected streams.

Connected streams in a MotionRuntime can be thought of as a connected graph, meaning they're naturally representable in graphviz.

## MVP

### Expose a toGraphViz API

```swift
class MotionRuntime {
  public func toGraphViz() -> String
}
```

### Return a complete graphviz string

```swift
digraph G {
  node [shape=rect]
  
  // Each line represents a connection in the runtime's graph
}
```
