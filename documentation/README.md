---
layout: docs
permalink: /documentation/
title: Documentation
---

# Introduction to Material Motion

Material Motion is designed to help you build **interactions**, the building blocks of motion. Interactions are composable, reactive entities that can be associated with user interfaces. One such interaction is `Draggable`, which we'll use in this introduction to make a view move around in reaction to human touch or pointer input.

Every interaction must be associated with an instance of `MotionRuntime` and this runtime instance must exist for as long as we want the interaction to be active:

```swift
// The container view is typically our view controller's view.
runtime = MotionRuntime(containerView: view)
```

We can now make any view respond to drag event by associating a `Draggable` interaction with it:

```swift
runtime.add(Draggable(), to: view)
```

The result:

![]({{ site.url }}/assets/interaction-draggable.gif)

