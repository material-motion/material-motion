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

Let's look at some other interaction types.

## Spring interactions

Unlike `Draggable`, `Spring` interactions must be associated with **reactive properties**. To animate the *position* of a view with a Spring we must acquire the view's position reactive property:

```swift
let position = runtime.get(view.layer).position
```

Separately we need to create our Spring interaction:

```swift
// We must specify the type of Spring because Spring is a generic type.
let spring = Spring<CGPoint>(threshold: 1, system: coreAnimation)
```

Like Draggable, we use `runtime.add` to associate the interaction with our property:

```swift
runtime.add(spring, to: position)
```

The position will now move to the spring's `destination`, which defaults to zero. How do we configure the spring's destination?

## Configuration interactions

Interactions often expose their own reactive properties. This lets us use interactions to control other interactions' behavior. We'd like to change where the position springs to so we'll make use of Spring's `destination` property.

Let's try adding a `SetPositionOnTap` interaction to our spring's destination:

```swift
runtime.add(SetPositionOnTap(), to: spring.destination)
```

We can now tap anywhere on the canvas to move the view.
