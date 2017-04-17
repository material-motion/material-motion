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

The `visualizationElement` API is a lazily-created element that's registered to the MotionRuntime's container element. This element can be provided to the `visualize(in: Element)` operator, allowing you to add visualization labels to the visualization element.

## MVP

### Lazily create the visualization element and store it on the runtime

This element should be added to the runtime's container element. This element should be stored on the runtime.

```swift
class MotionRuntime {
  public var visualizationView: UIView {
    if let visualizationView = _visualizationView {
      return visualizationView
    }

    let view = UIView(frame: .init(x: 0, y: containerView.bounds.maxY, width: containerView.bounds.width, height: 0))
    view.autoresizingMask = [.flexibleWidth, .flexibleTopMargin]
    view.isUserInteractionEnabled = false
    view.backgroundColor = UIColor(white: 0, alpha: 0.1)
    containerView.addSubview(view)
    _visualizationView = view

    return view
  }
  private var _visualizationView: UIView?
}
```

### Remove the visualization element when the runtime terminates

Ensure that you remove the visualization element when the runtime terminates.

```swift
class MotionRuntime {
  deinit {
    _visualizationView?.removeFromSuperview()
  }
```
