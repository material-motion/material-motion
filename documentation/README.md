---
layout: docs
permalink: /documentation/
title: Documentation
---

# Introduction to Material Motion

Material Motion includes a variety of ready-to-use **interactions**. An interaction is an object that can be associated with a visual element or a property. Interactions take effect immediately upon association.

In this introduction we'll associate a Draggable interaction with a view to make it respond to drag events.

Before we can associate any motion with our view we need to create a **runtime**.

> A runtime's container view should be the top-most view for your interactions. On iOS this is most commonly a view controller's root view.

```swift
let runtime = MotionRuntime(containerView: view)
```

Let's make the view draggable by adding a `Draggable` interaction to it.

```swift
runtime.add(Draggable(), to: view)
```

![]({{ site.url }}/assets/interaction-draggable.gif)
