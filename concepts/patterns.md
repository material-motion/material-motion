## Patterns

This section explores **software design patterns** that can be used to build modular, declarative motion systems.

We'll explore the use of these patterns in the section on [Runtimes](runtimes.md).

## The Expectation/Execution pattern

This pattern separates the **expectation** of motion from its **execution**.

This pattern is important because:

- It allows [Runtimes](runtimes.md) to offload expensive work to separate threads, processes, or workers.
- Tools can more easily affect the Expectation of motion than its execution. This enables the creation of rich design-focused tools.

### The Expectation of Motion

Expectation is simply **what you want something to do**.

Animations, Gestures, Physical Simulations, and other Primitives can all be described in some form. For example, we can describe an element as being both "draggable" and "fading in". These descriptions form an **expectation**.

Consider the following pseudo-code:

    fadeIn = Animation()
    fadeIn.property = "opacity"
    fadeIn.from = 0
    fadeIn.to = 1
    target.addExpectation(fadeIn)

Here, `fadeIn` is an Expectation.

The fading in of the target **is not executed here**. `addExpectation` has simply registered the Expectation of the desired change to some system. That system is expected to fulfill the Expectation at some later point in the program's execution.

Also consider this pseudo-code:

    behavior = CustomBehavior()
    behavior.animate = function() {
      // A custom animation.
    }
    target.addExpectation(behavior)

In this example, `CustomBehavior` is the Expectation. The `animate` function will be executed at a later point in the program's execution by a separate system.

Many Expectations can be attached to a single target. A single Expectation can also be attached to many targets.

Consider this pseudo-code:

    draggable = DraggableGesture()
    pinchable = PinchableGesture()
    rotatable = RotatableGesture()
    anchoredSpring = AnchoredSpringAtLocation(x, y)
    
    # Many Expectations to one element
    target.addExpectations(draggable, pinchable, rotatable, anchoredSpring)
    
    # Many targets for one Expectation
    target2.addExpectation(draggable)

`target` is now directly manipulable. When the user lets go of the element, it is pulled back to the x,y coordinate using a physical simulation of a dampened spring.

`target2` can simply be dragged.

### The Execution of Motion

An **Execution**'s sole responsibility is to fulfill the contract defined by a corresponding Expectation.

> How an Execution is implemented is less important than that the Execution fulfills its contract. Different types of Executions may be employed to fulfill different types of Expectation. Executions often interact with existing Execution-like systems in order to fulfill their contract.
>
> For example, a FadeIn Expectation might be fulfilled by a FadeInExecution. FadeInExecution might create a native Tween primitive and register it with an auxiliary animation system.
> 
> In an alternate universe, FadeInExecution might directly implement the necessary interpolation.  The Expectation doesn't know or care how it's fulfilled - that's the Execution's discretion.
>
> Good Executions will consider the runtime performance of their execution. The former Execution may be more performant if the opaque system is more closely built into the platform. The latter Execution may be less performant if it means the Execution must be executed on the main thread.

**Events**: Executions can ask to receive the following events:

- Animation events.
- Gesture recognition events.

**Activity**: An Execution is either active or dormant. An **active** Execution will generate change in response to input. Conversely, a **dormant** Execution will not generate change in response to input.

Examples of *active* Executions:

- Fulfilling a Pan Expectation while pan gesture events are being generated. 
- Fulfilling a Spring Attachment Expectation and the body has not yet reached its final resting state. 

Examples of *dormant* Executions:

- Fulfilling a Pan Expectation for which there are no pan gesture events. 
- Fulfilling a Spring Attachment Expectation and the body has reached its final resting state. 

The process or thread on which an Execution executes its contract depends on a combination of the types of Primitives it employs and assumptions already made by a given platform.

> Imagine a platform that executes user input on the main thread of the application while Tween animations are executed on a separate process altogether. A Gesture Execution would likely execute on the main thread. A Tween Execution would likely execute some or all of its logic on the separate process.

## The Coordination/Expectation pattern

A **Coordination** is a coordinating entity that describes an interactive experience by creating Expectations and associating them with specific elements.

> Imagine a transition between two states. A Coordination might create a Timeline and associate a variety of Tweens to various elements in the scene.

Coordinations may use Expectations that build upon any of the available Primitives. This enables the expression of **coordinated interactions**.

> Imagine a set of avatars as being draggable and, when not being dragged, the avatars gravitate toward the edges of a defined area. The Coordination might associate a Draggable Expectation with a given avatar. The Coordination might also associate a Spring Attachment Expectation to the avatar once the user has released it.

**Multiple Coordinations** can affect a given set of elements. The software designer is able to choose reasonable lines of responsibility.

> Imagine a horizontal carousel that can be expanded full screen. One Coordination might govern the horizontal movement of the carousel. Another Coordination might govern the expansion/collapse of the carousel to/from full screen.

It is important that the Coordination not have direct access to the Executions that implement the system. This separation of concerns allows Coordinations to live in the application space, while Executions are free to live anywhere else.

## Next up: Runtimes

The system that coordinates Coordinations, Expectations, and Executions is the [Runtime](runtimes.md).