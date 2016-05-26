# Patterns

This section explores **software design patterns** that can be used to build modular, declarative motion systems.

The chapter on [Runtimes](runtimes.md) explores the application of these ideas.

## The Intention/Actor pattern

The Intention/Actor pattern separates the **what (Intention)** from the **how (Actor)** in a motion system. This separation of concerns allows Runtimes to run at high frames-per-second (FPS) even if the thread responsible for describing Intention is busy.

### What (Intention)

Consider the following snippet of pseudo-code:

```
tween = FadeInTween()
element.addIntention(tween)
```

An intention is **what you want a thing to do**.

The logic that fulfills an Intention **is not executed here**, though it could be **described** here.

A system operating close to the compositing system is responsible for executing Intentions using **Actors**.

Intentions can be associated with a **target**. This is the object or value to which the Intention is expected to be applied.

> We’re careful to use the word Intention rather than animation. The word Intention can describe Gestures, Physical Simulation, and other Primitives. For example, an element could be both draggable and asked to fade in. Runtimes that think in terms of Intention can more easily coordinate relatively complex interactive experiences.

Consider the following pseudo-code:

draggable = DraggableGesture()pinchable = PinchableGesture()rotatable = RotatableGesture()anchoredSpring = AnchoredSpringAtLocation(x, y)element.addIntentions(draggable, pinchable, rotatable, anchoredSpring)

This element can now be directly manipulated. When the user lets go of the element, it will be pulled back to the x,y coordinate using a physical simulation of a dampened spring.

**

### How (Actor)

## 

An Actor’s sole responsibility is to fulfill the contract defined by a corresponding Intention.

How an Actor is implemented — be it an anonymous function or a class instance with state — is less important than that the Actor fulfills its contract. We leave it as a challenge to the reader to evaluate the merits of purely functional systems vs object-oriented systems.

Input: Actors can be asked to recalculate either in response to user input or whenever the platform is ready to draw another frame.

Activity: An Actor is either active or dormant. An active Actor will generate change in response to input. Conversely, a dormant actor will not generate change in response to input.

Examples of active Actors:

- Fulfilling a Pan Intention while pan gesture events are being generated. 
- Fulfilling a Spring Attachment Intention and the body has not yet reached its final resting state. 

Examples of dormant Actors:

- Fulfilling a Pan Intention for which there are no pan gesture events. 
- Fulfilling a Spring Attachment Intention and the body has reached its final resting state. 

The process or thread on which an Actor executes its contract depends on a combination of the types of Primitives it employs and assumptions already made by a given platform.

Consider a platform where user input is handled on the main thread of the application, while Tween animations are executed on a separate process altogether. A Gesture Actor would likely execute on the main thread. A Tween Actor would likely execute in the separate process.