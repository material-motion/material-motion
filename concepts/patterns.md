## Patterns

This section explores **software design patterns** that can be used to build modular, declarative motion systems.

We'll explore the use of these patterns in the section on [Runtimes](runtimes.md).

## The Plan/Execution pattern

This pattern separates the **plan** of motion from its **execution**.

This pattern is important because:

- It allows [Runtimes](runtimes.md) to offload expensive work to separate threads, processes, or workers.
- Tools can more easily affect the Plan of motion than its execution. This enables the creation of rich design-focused tools.

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

In this example, the logic of the `animate` function is the Plan. The `animate` function is not executed here. The behavior has been registered with a system. Again: it does not matter which system, so long as the system fulfills the Plan.

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

**Execution** is the fulfillment of an Plan.

How Execution occurs is less important than that it fulfills its Plans.

For example, an Plan of "fade in" could reasonably be fulfilled by a system animation system. The same Plan could also be fulfilled by a custom interpolation function.  The Plan doesn't know or care how it's fulfilled - that's the Execution's discretion.

Good Executions will consider the runtime performance of their execution. The former Execution may be more performant if the opaque system is more closely built into the platform. The latter Execution may be less performant if it means the Execution must be executed on the main thread.

**Events**: Executions can ask to receive the following events:

- Animation events.
- Gesture recognition events.

**Activity**: An Execution is either active or dormant. An **active** Execution will generate change in response to input. Conversely, a **dormant** Execution will not generate change in response to input.

Examples of *active* Executions:

- Fulfilling a Pan Plan while pan gesture events are being generated. 
- Fulfilling a Spring Attachment Plan and the body has not yet reached its final resting state. 

Examples of *dormant* Executions:

- Fulfilling a Pan Plan for which there are no pan gesture events. 
- Fulfilling a Spring Attachment Plan and the body has reached its final resting state. 

The process or thread on which an Execution executes its contract depends on a combination of the types of Primitives it employs and assumptions already made by a given platform.

> Imagine a platform that executes user input on the main thread of the application while Tween animations are executed on a separate process altogether. A Gesture Execution would likely execute on the main thread. A Tween Execution would likely execute some or all of its logic on the separate process.

## The Coordination/Plan pattern

A **Coordination** is a coordinating entity that describes an interactive experience by creating Plans and associating them with specific elements.

> Imagine a transition between two states. A Coordination might create a Timeline and associate a variety of Tweens to various elements in the scene.

Coordinations may use Plans that build upon any of the available Primitives. This enables the expression of **coordinated interactions**.

> Imagine a set of avatars as being draggable and, when not being dragged, the avatars gravitate toward the edges of a defined area. The Coordination might associate a Draggable Plan with a given avatar. The Coordination might also associate a Spring Attachment Plan to the avatar once the user has released it.

**Multiple Coordinations** can affect a given set of elements. The software designer is able to choose reasonable lines of responsibility.

> Imagine a horizontal carousel that can be expanded full screen. One Coordination might govern the horizontal movement of the carousel. Another Coordination might govern the expansion/collapse of the carousel to/from full screen.

It is important that the Coordination not have direct access to the Executions that implement the system. This separation of concerns allows Coordinations to live in the application space, while Executions are free to live anywhere else.

## Next up: Runtimes

The system that coordinates Coordinations, Plans, and Executions is the [Runtime](runtimes.md).