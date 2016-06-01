## Patterns

This section explores **software design patterns** that can be used to build modular, declarative motion systems.

We'll explore the use of these patterns in the section on [Runtimes](runtimes.md).

## The Description/Execution pattern

This pattern separates the **description** of motion from its **execution**.

This pattern is important because:

- It allows [Runtimes](runtimes.md) to offload expensive work to separate threads, processes, or workers.
- Tools can more easily affect the description of motion than its execution. This enables the creation of rich design-focused tools.

#### Notation we use

We use the following notation to describe a Description/Execution relationship: `<Description>(<Execution>)`.

For example, `CAAnimation(Core Animation)` describes the Description/Execution relationship of iOS' animation system.

### The role of Description

Description is simply **what you want something to do**.

Animations, Gestures, Physical Simulations, and other Primitives can all be described in some form. For example, we can describe an element as being both "draggable" and "fading in".

Consider the following pseudo-code:

    tween = FadeInTween()
    target.addDescription(tween)

Here, `FadeInTween` is the Description. The logic that fulfills FadeInTween **is not executed here**. The Description has been handed off to some system via `addDescription`. That system will soon execute the Description.

Also consider this pseudo-code:

    behavior = CustomBehavior()
    behavior.animate = function() {
      // A custom animation.
    }
    target.addDescription(behavior)

In this example, `CustomBehavior` represents the concept of Description. The `animate` function can be executed by a separate system.

The **Description/target relationship is many-to-many**. This means that many Descriptions can be attached to a single target. A single Description can also be attached to many targets.

Consider this pseudo-code:

    draggable = DraggableGesture()
    pinchable = PinchableGesture()
    rotatable = RotatableGesture()
    anchoredSpring = AnchoredSpringAtLocation(x, y)
    
    # Many Descriptions to one element
    target.addDescriptions(draggable, pinchable, rotatable, anchoredSpring)
    
    # Many targets for one Description
    target2.addDescription(draggable)

`target` is now directly manipulable. When the user lets go of the element, it is pulled back to the x,y coordinate using a physical simulation of a dampened spring.

`target2` can simply be dragged.

### The role of Execution

An **Execution**'s sole responsibility is to fulfill the contract defined by a corresponding Description.

> How an Execution is implemented is less important than that the Execution fulfills its contract. Different types of Executions may be employed to fulfill different types of Description. Executions often interact with existing Execution-like systems in order to fulfill their contract.
>
> For example, a FadeIn Description might be fulfilled by a FadeInExecution. FadeInExecution might create a native Tween primitive and register it with an auxiliary animation system.
> 
> In an alternate universe, FadeInExecution might directly implement the necessary interpolation.  The Description doesn't know or care how it's fulfilled - that's the Execution's discretion.
>
> Good Executions will consider the runtime performance of their execution. The former Execution may be more performant if the opaque system is more closely built into the platform. The latter Execution may be less performant if it means the Execution must be executed on the main thread.

**Events**: Executions can ask to receive the following events:

- Animation events.
- Gesture recognition events.

**Activity**: An Execution is either active or dormant. An **active** Execution will generate change in response to input. Conversely, a **dormant** Execution will not generate change in response to input.

Examples of *active* Executions:

- Fulfilling a Pan Description while pan gesture events are being generated. 
- Fulfilling a Spring Attachment Description and the body has not yet reached its final resting state. 

Examples of *dormant* Executions:

- Fulfilling a Pan Description for which there are no pan gesture events. 
- Fulfilling a Spring Attachment Description and the body has reached its final resting state. 

The process or thread on which an Execution executes its contract depends on a combination of the types of Primitives it employs and assumptions already made by a given platform.

> Imagine a platform that executes user input on the main thread of the application while Tween animations are executed on a separate process altogether. A Gesture Execution would likely execute on the main thread. A Tween Execution would likely execute some or all of its logic on the separate process.

## The Coordination/Description pattern

A **Coordination** is a coordinating entity that describes an interactive experience by creating Descriptions and associating them with specific elements.

> Imagine a transition between two states. A Coordination might create a Timeline and associate a variety of Tweens to various elements in the scene.

Coordinations may use Descriptions that build upon any of the available Primitives. This enables the expression of **coordinated interactions**.

> Imagine a set of avatars as being draggable and, when not being dragged, the avatars gravitate toward the edges of a defined area. The Coordination might associate a Draggable Description with a given avatar. The Coordination might also associate a Spring Attachment Description to the avatar once the user has released it.

**Multiple Coordinations** can affect a given set of elements. The software designer is able to choose reasonable lines of responsibility.

> Imagine a horizontal carousel that can be expanded full screen. One Coordination might govern the horizontal movement of the carousel. Another Coordination might govern the expansion/collapse of the carousel to/from full screen.

It is important that the Coordination not have direct access to the Executions that implement the system. This separation of concerns allows Coordinations to live in the application space, while Executions are free to live anywhere else.

## Next up: Runtimes

The system that coordinates Coordinations, Descriptions, and Executions is the [Runtime](runtimes.md).