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

## Configuring interactions

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

## How to create new interactions

Once we've identified a combination of interactions that we feel is useful, it's time to create a new `Interaction` type representing these combinations. Start by defining a new class conforming to the `Interaction` protocol.

```swift
final class MyTossable: Interaction {
}
```

Recall that Tossable is composed of two interactions: Draggable and Spring. We'll accept instances of both of these in our initializer.

```swift
final class MyTossable: Interaction {
  let draggable: Draggable
  let spring: Spring<CGPoint>

  init(spring: Spring<CGPoint>, draggable: Draggable = Draggable()) {
    self.spring = spring
    self.draggable = draggable
  }
}
```

The Interaction protocol requires that we implement a single method: `add`. This method defines two generic types: the interaction's **target type** and the optional **constraint type**. This method will be invoked by the runtime when we call `runtime.add` with an instance of this interaction.

In this case we want our interaction to be registered to instances of UIView and we won't support any constraints.

```swift
  func add(to target: UIView, withRuntime runtime: MotionRuntime, constraints: NoConstraints) {
    let position = runtime.get(view.layer).position

    runtime.add(draggable.finalVelocity, to: spring.initialVelocity)

    runtime.toggle(spring, inReactionTo: draggable)
    runtime.add(spring, to: position)
    runtime.add(draggable, to: view)
  }
}
```

Using our new interaction is a matter of instantiating it and associating it with a view:

```swift
let tossable = MyTossable(spring: .init(threshold: 1, system: coreAnimation))
runtime.add(tossable, to: view)

runtime.add(SetPositionOnTap(), to: tossable.spring.destination)
```

## How to apply constraints

Constraints can be applied to interactions in order to modify their behavior. A constraint receives values, does something with them, and emits values of the same type.

Constraints are added to an interaction via the `runtime.add` API. The last argument to runtime.add is the optional constraint argument. In long-form, we might write a constraint like so:

```swift
runtime.add(draggable, to: view, constraints: { $0.log() })
```

When a method's last argument is a block in Swift, we can drop the named parameter and use the following short-hand instead:

```swift
runtime.add(draggable, to: view) { $0.log() }
```

We'll generally prefer this short-hand when using constraints throughout the examples.

The first constraint you'll likely become familiar with is `log()`. This constraint writes anything it receives to the console.

Try out these other constraints to see their effect on the interaction:

```swift
runtime.add(draggable, to: view) { $0.log() }
runtime.add(draggable, to: view) { $0.xLocked(to: 100) }
runtime.add(draggable, to: view) { $0.yLocked(to: 100) }
```
