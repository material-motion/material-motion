## The Plan/Fulfillment pattern

This pattern emphasizes a **separation** of the *plan* of motion from its *fulfillment*.

This pattern is important because:

- It allows expensive work to execute on separate threads, processes, or workers.
- Fulfillment is, in practice, code. Plans could be code, but they can more easily be represented with rich user interfaces or even sent over a wire.

### A Plan of Motion

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

### Fulfillment of a Plan

Exactly how a Plan is fulfilled is less important than that it **is** fulfilled.

For example, a Plan of "fade in" could reasonably be fulfilled by a system animation. The same Plan could also be fulfilled by a custom interpolation function.  The Plan doesn't know or care how it's fulfilled.

Good systems of fulfillment will carefully balance runtime performance, power consumption, and event coordination.

We'll explore one particular implementation of an fulfillment system in the chapter on [Runtimes](runtimes.md).

## Examples of this pattern

