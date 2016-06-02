## Patterns

This section explores **software design patterns** that can be used to build modular, declarative motion systems.

We'll explore the use of these patterns in the section on [Runtimes](runtimes.md).

## The Plan/Execution pattern

This pattern emphasizes a **separation** of the *plan* of motion from its *execution*.

This pattern is important because:

- It allows expensive work to execute on separate threads, processes, or workers.
- Execution is, in practice, code. Plans could be code, but they can more easily be represented with rich user interfaces or even sent over a wire.

### The Plan of Motion

A Plan is simply **what you want something to do**.

Each of the Primitives we explored in [the previous section](primitives.md) can be described as a Plan in some form. For example, "draggable" and "fade in" are two distinct Plans.

Consider the following pseudo-code:

    fadeIn = Animation()
    fadeIn.property = "opacity"
    fadeIn.from = 0
    fadeIn.to = 1
    target.addPlan(fadeIn)

Here, `fadeIn` is the Plan. Note that the fading in of the target **is not executed here**.

`addPlan` has registered the Plan to a system. It does not matter which system, so long as the Plan is eventually fulfilled.

Also consider this pseudo-code:

    behavior = CustomBehavior()
    behavior.animate = function() {
      // A custom animation.
    }
    target.addPlan(behavior)

In this example, the logic of the `animate` function is the Plan. The `animate` function is not executed here. The `behavior` instance has been registered with a system. Again: it does not matter which system, so long as the Plan is eventually fulfilled.

Many Plans can be attached to a single target. A single Plan can also be attached to many targets.

Consider this pseudo-code:

    draggable = DraggableGesture()
    pinchable = PinchableGesture()
    rotatable = RotatableGesture()
    anchoredSpring = AnchoredSpringAtLocation(x, y)
    
    # Adding many Plans to one target
    target.addPlans(draggable, pinchable, rotatable, anchoredSpring)
    
    # Reusing an Plan on a second target
    target2.addPlan(draggable)

`target` is now expected to be directly manipulable. The target is also expected to spring back to the given x,y coordinate. Whether this happens on release or whether the target is constantly being pulled back is up to the system.

`target2` is simply expected to be draggable.

### The Execution of Motion

**Execution** is the fulfillment of a Plan.

How Execution occurs is less important than that it fulfills its Plans.

For example, a Plan of "fade in" could reasonably be fulfilled by a system animation. The same Plan could also be fulfilled by a custom interpolation function.  The Plan doesn't know or care how it's fulfilled - that's the Execution's discretion.

Good systems of Execution will carefully balance runtime performance, power consumption, and event coordination.

We'll explore one particular implementation of an Execution system in the [Runtimes](runtimes.md).

## The Coordinator/Plan pattern

A **Coordinator** describes an interactive experience by creating Plans and associating them with targets.

> Imagine a transition between two states. A Coordinator might create a [Timeline](primitives.md) and associate many Tweens with elements in the scene.

Coordinators use Plans that may be executed by any of the available [Primitives](primitives.md). This enables the expression of **coordinated interactions** involving gestures, animations, and physical simulation.

> Imagine a set of avatars as being draggable and, when not being dragged, the avatars gravitate toward the edges of a defined area. The Coordinator might associate a Draggable Plan with a given avatar. The Coordination might also associate a Spring Attachment Plan to the avatar once the user has released it.

**Multiple Coordinators** can affect a given set of elements. The software designer must choose reasonable lines of overlapping responsibility.

> Imagine a horizontal carousel that can be expanded full screen. One Coordinator might govern the horizontal movement of the carousel. Another Coordinator might govern the expansion/collapse of the carousel to/from full screen.

It is important that the Coordinator not be involved in the Execution of any Plans. Coordinators generally live in the "application" space, while Executions may occur anywhere else.

This pattern allows Coordinators to be written in a separate language from the application code (see: [Runtime](runtime.md)). It allows Coordinators to communicate over the wire between devices (see: [Applications](../applications/).

## Next up: Runtimes

The system that coordinates Coordinations, Plans, and Executions is the [Runtime](runtimes.md).