---
layout: page
title: Pattern
---

## Declarative motion

This section defines a software design pattern. The pattern involves a [declarative separation](https://en.wikipedia.org/wiki/Declarative_programming) between **plans** and their ultimate **execution**.

**Plan**: a detailed proposal for what you want something to do or how you want it to behave.

**Execution**: the carrying out or putting into effect of a plan, order, or course of action.

Benefits of this separation:

- It allows execution to occur in a separate, potentially non-blocking context.
- It enables design tooling and bespoke applications to communicate in a language that isn't code.

## Examples of this separation

Most platforms have an implementation of this separation for tween animations. Few platforms have implemented this separation for other [primitives](primitives.md).

![]({{ site.url }}/assets/PatternMatches.svg)

### A plan of motion

We use *plan* to mean **what you want something to do** or **how you want it to behave**.

For example, "fade in" and "be draggable" are two distinct plans.

Consider the following pseudo-code:

    fadeIn = {
      property: 'opacity',
      from: 0,
      to: 1
    }
    system.addPlan(fadeIn, toTarget: target)

Here, the object `fadeIn` is the plan. The "fade in" logic **is not fulfilled here**.

`addPlan` has registered the plan to a system. It does not matter which system, so long as the plan is eventually fulfilled.

Also consider this pseudo-code:

    behavior = CustomBehavior()
    behavior.animate = function() {
      // A custom animation.
    }
    system.addPlan(behavior, toTarget: target)

In this example, the logic of the `animate` function is the plan. The `animate` function is not executed here.

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

`target` is now expected to be directly manipulable. The target is also expected to spring back to the given `{ x, y }` coordinate. Whether this happens on release or at all times is an implementation detail of the plan's fulfillment.

`target2` is expected to be draggable.

### Fulfillment of a plan

In a declarative motion system, exactly **how** a plan is executed is less important than that it is **fulfilled by some other system** other than that which declared the plan.

For example, a plan of "fade in" could reasonably be fulfilled by a built-in animation system. The same plan could also be fulfilled by a custom function executed.

An ideal fulfillment will carefully balance the considerations of power consumption, event coordination, and user interaction.

## Existing solutions and research

- [Functional Reactive Animation](http://haskell.cs.yale.edu/wp-content/uploads/2011/02/icfp97.pdf)
- [Core Animation](https://developer.apple.com/library/ios/documentation/Cocoa/Conceptual/CoreAnimation_guide/CoreAnimationBasics/CoreAnimationBasics.html)
- [Web Animations](https://w3c.github.io/web-animations/)

## A Motion Runtime

This Starmap defines a novel system of declarative motion which we'll call the "Motion Runtime".

Next: [Motion Runtime](runtime/).
