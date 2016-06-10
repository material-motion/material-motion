Status of this document: **Stable**

## The definition/execution pattern

This pattern emphasizes a **separation** of the *definition* of motion from its *execution*.

This pattern is important because:

- It allows execution to occur in separate threads, processes, or workers.
- Execution relies on code. Definitions can be represented in rich user interfaces. Definitions can also be sent "over the wire".

### A definition of motion

A definition is **what you want something to do**.

Every [primitive](../primitives.md) can be described with a definition of motion. For example, "draggable" and "fade in" are two distinct definitions of motion that use Gesture and Tween primitives.

Consider the following pseudo-code:

    fadeIn = Animation()
    fadeIn.property = "opacity"
    fadeIn.from = 0
    fadeIn.to = 1
    target.addDefinition(fadeIn)

Here, `fadeIn` is the definition. The execution of "fade in" **is not executed here**.

`addDefinition` has registered the definition to a system. It does not matter which system, so long as the definition is eventually executed.

Also consider this pseudo-code:

    behavior = CustomBehavior()
    behavior.animate = function() {
      // A custom animation.
    }
    target.adddefinition(behavior)

In this example, the logic of the `animate` function is the definition. The `animate` function is not executed here. The `behavior` instance has been registered with a system. Again: it does not matter which system, so long as the definition is eventually fulfilled.

> **Note:** This is only an example to emphasize the separation between declaration and execution.  Take care to author code that suits your platform.  Function definitions may not be portable across thread/worker boundaries on some platforms.

Many definitions can be attached to a single target. A single definition can also be attached to many targets.

Consider this pseudo-code:

    draggable = DraggableGesture()
    pinchable = PinchableGesture()
    rotatable = RotatableGesture()
    anchoredSpring = AnchoredSpringAtLocation(x, y)
    
    # Adding many definitions to one target
    target.adddefinitions(draggable, pinchable, rotatable, anchoredSpring)
    
    # Reusing a definition on a second target
    target2.adddefinition(draggable)

`target` is now expected to be directly manipulable. The target is also expected to spring back to the given `{ x, y }` coordinate. Whether this happens on release or at all times is an execution detail of the definition's execution. `target2` is simply expected to be draggable.

### execution of a definition

Exactly how a definition is fulfilled is less important than that it **is** fulfilled and that the execution is able to occur elsewhere.

For example, a definition of "fade in" could reasonably be fulfilled by a built-in animation system. The same definition could also be fulfilled by a custom interpolation function. The definition doesn't know or care how it's fulfilled.

Good systems of execution will carefully balance the needs of performance, power consumption, event coordination, and user interaction.

## Examples of this pattern

Most platforms have an execution of this pattern for Tween animations. Few platforms, however, have implemented this pattern for other types of [Primitive](../primitives.md).

![](../_assets/PatternMatches.svg)