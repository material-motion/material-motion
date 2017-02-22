---
layout: page
title: anchorPointAdjustment
status:
  date: February 21, 2016
  is: Stable
interfacelevel: L2
implementationlevel: L3
library: reactive-motion
depends_on:
  - /starmap/specifications/operators/foundation/_map
availability:
  - platform:
    name: iOS (Swift)
    url: https://github.com/material-motion/reactive-motion-swift/blob/develop/src/operators/anchorPointAdjustment.swift
interaction:
  inputs:
    - input:
      name: upstream
      type: Point
    - input:
      name: element
      type: Element
  outputs:
    - output:
      name: downstream
      type: AnchorPointAdjustment
---

# anchorPointAdjustment specification

This is the engineering specification for the `MotionObservable` operator: `anchorPointAdjustment`.

## Overview

`anchorPointAdjustment` emits an anchor point adjustment calculated from the upstream anchor point
and the provided element. The emitted adjustment can be used to change the element's anchor point
and position while maintaining the element's frame in relation to its parent element.

## Example usage

```swift
stream.anchorPointAdjustment(element: someElement)

upstream  element      downstream
{1, 0}    someElement  {anchorPoint: {1, 0}, position: <adjusted position>}
```

## MVP

### Expose an AnchorPointAdjustment type

This type should store an anchor point and a position.

```swift
public struct AnchorPointAdjustment {
  let anchorPoint: CGPoint
  let position: CGPoint
}
```

### Expose an anchorPointAdjustment operator API

Use `_map` to implement the operator. The upstream type is Point. Accept an element. Emit an
instance of AnchorPointAdjustment.

```swift
class MotionObservable<Point> {
  public func anchorPointAdjustment(in element: Element) -> MotionObservable<AnchorPointAdjustment>
```

### Calculate and emit the new position

```swift
class MotionObservable<Point> {
  public func anchorPointAdjustment(in element: Element) -> MotionObservable<AnchorPointAdjustment> {
    return _map { anchorPoint in
      let newPosition = Point(x: anchorPoint.x * element.width,
                              y: anchorPoint.y * element.height)
      let positionInParent = element.convert(newPosition, to: element.parent)
      return AnchorPointAdjustment(anchorPoint: anchorPoint, position: positionInParent)
    }
  }
```
