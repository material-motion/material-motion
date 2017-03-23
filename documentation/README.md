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

We can now tap anywhere to move the view.

## How to combine interactions

We can create new interactions by combining interactions in interesting ways. For example, *Tossable* is a combination of `Spring` and `Draggable`. Let's walk through the process by which we might invent a new interaction like `Tossable`.

First we create the interactions we know we'll need: Spring and Draggable.

```swift
let spring = Spring<CGPoint>(threshold: 1, system: coreAnimation)
let draggable = Draggable()
```

Inspecting Draggable's documentation reveals that it will affect the view's layer position, so let's make sure we use the same property for our spring:

```swift
let position = runtime.get(view.layer).position
```

If we associate our interactions right now we'll notice something unsurprising: we can drag the view, but when we let go nothing happens. This is because we haven't combined the interactions in any way.

```swift
runtime.add(spring, to: position)
runtime.add(draggable, to: view)
```

---

### Toggling interactions

Many interactions can be **toggled**. Togglable interactions can be disabled and enabled.

When an interaction is **disabled** it will stop any motion associated with it. For example, when a spring is disabled it will stop moving toward its destination.

When an interaction is **enabled** it will start moving again, often by re-initializing the animation with new initial values such as the current value of the property being affected.

---

When we finish dragging we want our spring interaction to start animating, so this is a perfect use of toggling. We can create a toggling association between two interactions using `runtime.toggle`. Try pasting the following example into the playground.

```swift
runtime.toggle(spring, inReactionTo: draggable)

runtime.add(spring, to: position)
runtime.add(draggable, to: view)
```

You can now drag the view and, upon release, the view will snap back to its destination.

You may have noticed that if you release while quickly dragging that the view doesn't appear to respect the final velocity of your gesture. Let's make this interaction more believable by connecting our draggable gesture's final velocity to our spring's **initial velocity**.

```swift
runtime.add(draggable.finalVelocity, to: spring.initialVelocity)

runtime.toggle(spring, inReactionTo: draggable)
runtime.add(spring, to: position)
runtime.add(draggable, to: view)
```

> Order is important here: we want to ensure that our spring's initial velocity is configured before the spring is toggled by the draggable gesture, otherwise our spring won't have access to the velocity when it's re-enabled.

We've now created the parts necessary for a `Tossable` interaction. We certainly don't want to have to remember to build these pieces every time we want an interaction like this, so on the next page we'll learn how to create new Interaction types.
