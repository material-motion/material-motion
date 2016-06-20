## Separation of plan/execution

This section defines a software design pattern.

**Plan**: a detailed proposal for doing or achieving something.

**Execution**: the carrying out or putting into effect of a plan, order, or course of action.

Separating plans of motion from their execution is important because:

- It allows execution to occur in a separate, potentially non-blocking context.
- It enables design tooling and engineering to communicate in a language that isn't code.

## Examples of this separation

Most platforms have an implementation of this separation for tween animations. Few platforms have implemented this separation for other [primitives](../primitives.md).

![](_assets/PatternMatches.svg)

### A plan of motion

We use *plan* to mean **what you want something to do** or **how you want it to behave**.

For example, "fade in" and "draggable" are two distinct plans. Their execution might use gesture and tween primitives.

Consider the following pseudo-code:

    fadeIn = {
      property: 'opacity',
      from: 0,
      to: 1
    }
    system.addPlan(fadeIn, toTarget: target)

Here, the object `fadeIn` is the plan. The "fade in" logic **is not executed here**.

`addPlan` has registered the plan to a system. It does not matter which system, so long as the plan is eventually executed.

Also consider this pseudo-code:

    behavior = CustomBehavior()
    behavior.animate = function() {
      // A custom animation.
    }
    system.addPlan(fadeIn, toTarget: target)

In this example, the logic of the `animate` function is the plan. The `animate` function is not executed here. The `behavior` instance has been registered with a system. Again: it does not matter which system, so long as the plan is eventually executed.

> **Note:** Take care to author code that suits your platform. Plans that include functions may not be portable across thread/worker boundaries on some platforms.

Many plans can be attached to a single target. A single plan can also be attached to many targets.

Consider this pseudo-code:

    draggable = Draggable()
    pinchable = Pinchable()
    rotatable = Rotatable()
    anchoredSpring = AnchoredSpringAtLocation(x, y)
    
    # Adding many plans to one target
    system.addPlans(draggable, pinchable, rotatable, anchoredSpring, toTarget: target)
    
    # Reusing a plan on a second target
    system.addPlan(draggable, toTarget: target2)

`target` is now expected to be directly manipulable. The target is also expected to spring back to the given `{ x, y }` coordinate. Whether this happens on release or at all times is an implementation detail of the plan's execution.

`target2` is expected to be draggable.

### Execution of a plan

Exactly how a plan is executed is less important than that it **is** executed and that the execution is able to occur elsewhere.

For example, a plan of "fade in" could reasonably be executed by a built-in animation system. The same plan could also be executed by a custom interpolation function. The plan doesn't know or care how it's executed.

Good systems of execution will carefully balance the needs of performance, power consumption, event coordination, and user interaction.

## Prior art and research

- [Functional Reactive Animation](http://haskell.cs.yale.edu/wp-content/uploads/2011/02/icfp97.pdf)
- [Core Animation](https://developer.apple.com/library/ios/documentation/Cocoa/Conceptual/CoreAnimation_guide/CoreAnimationBasics/CoreAnimationBasics.html)
- [Web animations](https://w3c.github.io/web-animations/)

<!--

LGTM:
- featherless
- larche
- markwei

-->
