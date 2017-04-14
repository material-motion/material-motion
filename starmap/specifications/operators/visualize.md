---
layout: page
title: visualize
status:
  date: April 14, 2017
  is: Proposed
interfacelevel: L2
implementationlevel: L3
library: material-motion
depends_on:
  - /starmap/specifications/runtime/MotionRuntime-visualizationElement
  - /starmap/specifications/observable/MotionObservable
  - /starmap/specifications/operators/dedupe
  - /starmap/specifications/operators/toString
availability:
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/material-motion-swift/blob/develop/src/operators/visualize.swift
proposals:
  - proposal:
    initiation_date: April 14, 2017
    state: Draft
    discussion: "Initial proposal"
interaction:
  inputs:
    - input:
      name: upstream
      type: T
  outputs:
    - output:
      name: downstream
      type: T
---

# visualize specification

This is the engineering specification for the `MotionObservable` operator: `visualize`.

## Overview

`visualize` writes any upstream value to a visible label and emits the value without modification.

Example usage:

```swift
stream.visualize(in: runtime.visualizationElement)

upstream  |  downstream  |  label.text
20        |  20          |  20
40        |  40          |  40
80        |  80          |  80
```

```swift
stream.visualize(prefix: "The value is: ", in: runtime.visualizationElement)

upstream  |  downstream  |  label.text
20        |  20          |  The value is: 20
40        |  40          |  The value is: 40
80        |  80          |  The value is: 80
```

## MVP

### Expose a visualize operator API

Use `MotionObservable` to implement the operator. Accept an optional prefix string and an element to which the visualization label will be added.

```swift
class MotionObservable {
  public func visualize(prefix: String? = nil, in: Element) -> MotionObservable<T>
```

### Create a new label and add it to the visualization element

Create a new label on each connection and append it to the visualization element.

### Subscribe to the stream and write values to the label

Create a new label and subscribe to the upstream, writing emitted values to the label as they're received. Flash the label with a background color in order to draw attention to the fact that the value changed.

```swift
class MotionObservable {
  public func visualize(prefix: String? = nil, in: Element) -> MotionObservable<T>
    let visualizationSubscription = self.asStream().toString().dedupe().subscribeToValue { value in
      label.text = (prefix ?? "") + stringValue

      highlight.alpha = 1
      UIView.animate(withDuration: 0.3) {
        highlight.alpha = 0
      }
    }

    let subscription = self.asStream().subscribeAndForward(to: observer)

    return {
      visualizationSubscription.unsubscribe()
      subscription.unsubscribe()
    }
  }
}
```
