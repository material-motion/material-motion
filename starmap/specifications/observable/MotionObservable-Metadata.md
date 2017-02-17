---
layout: page
title: Metadata
status:
  date: December 4, 2016
  is: Draft
knowledgelevel: L4
library: reactive-motion
depends_on:
  - /starmap/specifications/observable/MotionObservable
---

# Metadata feature specification for MotionObservable

This is the engineering specification for the `Metadata` object.

## Overview

In order provide introspection capabilities, each `MotionObservable` instance is expected to store a
small amount of meta information about itself. This information is stored in an object called
`Metadata`.

The metadata is currently being considered for use in visualizing the graph of connected streams in
a runtime. Example code:

```swift
runtime.add(Draggable(), to: square)

timeline.timeOffset.value = CGFloat(slider.value * 0.4)
timeline.paused.value = true

let arcMove = ArcMove(duration: 0.4,
                      from: runtime.get(square.layer).position,
                      to: runtime.get(circle.layer).position,
                      system: coreAnimation)
arcMove.timeline = timeline
runtime.add(arcMove, to: square2)
```

Example output:

```
digraph G {
  node [shape=rect]
  {"translated(from:in:)(BF5FE183-A435-4FB2-9CA9-8082C3B97D14)" [label="translated(from:\nReactiveProperty<__C.CGPoint>::0x600000178c00,\nin:\nUIView::0x7f848a410900)", style=filled, fillcolor="#DB4437"]} -> {"CALayer::0x60000002d660.position" [label="CALayer::0x60000002d660.position", style=filled, fillcolor="#FFFFFF"]}
  {"CALayer::0x60000002d660.position" [label="CALayer::0x60000002d660.position", style=filled, fillcolor="#0F9D58"]} -> {"translated(from:in:)(BF5FE183-A435-4FB2-9CA9-8082C3B97D14)" [label="translated(from:\nReactiveProperty<__C.CGPoint>::0x600000178c00,\nin:\nUIView::0x7f848a410900)(BF5FE183-A435-4FB2-9CA9-8082C3B97D14)", style=filled, fillcolor="#FFFFFF"]}
  {"Gesture Recognizer(029F6C3D-A254-4CE9-B991-F3905AB262EE)" [label="Gesture Recognizer(:\nUIPanGestureRecognizer::0x7f848a513bc0)", style=filled, fillcolor="#FFFFFF"]} -> {"translated(from:in:)(BF5FE183-A435-4FB2-9CA9-8082C3B97D14)" [label="translated(from:\nReactiveProperty<__C.CGPoint>::0x600000178c00,\nin:\nUIView::0x7f848a410900)", style=filled, fillcolor="#DB4437"]}
  {"Core Animation Path Tween(F2DC1810-419F-4077-8642-584439BF9D0D)" [label="Core Animation Path Tween(:\nMotionObservable<CoreGraphics.CGFloat>::0x600000246c00)", style=filled, fillcolor="#FFFFFF"]} -> {"CALayer::0x60000002d5e0.position" [label="CALayer::0x60000002d5e0.position", style=filled, fillcolor="#FFFFFF"]}
  {"PathTween.duration(72BCFA57-F958-4519-A725-316C63792BC3)" [label="PathTween.duration", style=filled, fillcolor="#0F9D58"]} -> {"Core Animation Path Tween(F2DC1810-419F-4077-8642-584439BF9D0D)" [label="Core Animation Path Tween(F2DC1810-419F-4077-8642-584439BF9D0D):\nMotionObservable<CoreGraphics.CGFloat>::0x600000246c00", style=filled, fillcolor="#FFFFFF"]}
  {"arcMove(from:to:)" [label="arcMove(from:\nMotionObservable<__C.CGPoint>::0x6000002468d0,\nto:\nMotionObservable<__C.CGPoint>::0x6000002468a0)", style=filled, fillcolor="#FFFFFF"]} -> {"Core Animation Path Tween(F2DC1810-419F-4077-8642-584439BF9D0D)" [label="Core Animation Path Tween(F2DC1810-419F-4077-8642-584439BF9D0D):\nMotionObservable<CoreGraphics.CGFloat>::0x600000246c00", style=filled, fillcolor="#FFFFFF"]}
  {"CALayer::0x60000002d660.position" [label="CALayer::0x60000002d660.position", style=filled, fillcolor="#0F9D58"]} -> {"arcMove(from:to:)" [label="arcMove(from:\nMotionObservable<__C.CGPoint>::0x6000002468d0,\nto:\nMotionObservable<__C.CGPoint>::0x6000002468a0)", style=filled, fillcolor="#FFFFFF"]}
  {"CALayer::0x60000002d380.position" [label="CALayer::0x60000002d380.position", style=filled, fillcolor="#0F9D58"]} -> {"arcMove(from:to:)" [label="arcMove(from:\nMotionObservable<__C.CGPoint>::0x6000002468d0,\nto:\nMotionObservable<__C.CGPoint>::0x6000002468a0)", style=filled, fillcolor="#FFFFFF"]}
  {"PathTween.enabled(E1F7BB29-2A35-438C-A49A-4458161EA08E)" [label="PathTween.enabled", style=filled, fillcolor="#0F9D58"]} -> {"Core Animation Path Tween(F2DC1810-419F-4077-8642-584439BF9D0D)" [label="Core Animation Path Tween(F2DC1810-419F-4077-8642-584439BF9D0D):\nMotionObservable<CoreGraphics.CGFloat>::0x600000246c00", style=filled, fillcolor="#FFFFFF"]}
  {"PathTween.state(E1F7BB29-2A35-438C-A49A-4458161EA08E)" [label="PathTween.state", style=filled, fillcolor="#0F9D58"]} -> {"Core Animation Path Tween(F2DC1810-419F-4077-8642-584439BF9D0D)" [label="Core Animation Path Tween(F2DC1810-419F-4077-8642-584439BF9D0D):\nMotionObservable<CoreGraphics.CGFloat>::0x600000246c00", style=filled, fillcolor="#FFFFFF"]}
}
````

![]({{ site.url }}/assets/stream-visualization.png)

## MVP

### Expose a Metadata type

Expose a public class type named `Metadata`.

```swift
public class Metadata {
}
```

### Store name, uuid, and args

```swift
class Metadata {
  public const var identifier: String
  public const var label: String
  public const var args: [Any]?
  private var parent: OperatorMetadata?

  init(_ identifier: String, objectIdentifier: String? args: [Any]?, parent: Metadata?) {
    if let objectIdentifier = objectIdentifier {
      self.identifier = objectIdentifier + identifier
    } else {
      self.identifier = identifier
    }
    self.label = identifier
    self.args = args
    self.parent = parent
  }
```

### Expose with API

Expose a `with` method that creates a new OperatorMetadata with self as its parent.

```swift
class Metadata {
  public func with(_ name: String, args: [Any]? = nil) -> Metadata {
    return .init(name, args: args, parent: self)
  }
```

### Expose debug description API

Expose a debug description method. The output is expected to be a recursive representation of this
metadata and all of its ancestral metadata.

```swift
class Metadata {
  public var debugDescription: String {
  }
```

[View the issue tracking formalization of the debug description](https://github.com/material-motion/starmap/issues/90).

### Store a constant metadata instance on each MotionObservable

```swift
class MotionObservable {
  public const var metadata: Metadata
}
```
