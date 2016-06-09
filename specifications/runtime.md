Status of this document: **Draft**

# Runtime

The system we propose here is an implementation of the [Plan/Fulfillment](../concepts/plan-fulfillment.md) pattern. We call it a Runtime.

## Purpose

The purpose of a Runtime is to coordinate the expression of diverse types of motion and interaction. It as an abstraction layer between the application engineer and existing systems of fulfillment.

The following diagram shows where the Runtime lives in relation to a platform like iOS.

![](../_assets/Abstraction.svg)

As we'll discuss in detail below, the Runtime acts as a fulfillment engine for objects we call Intention.

## Overview

An instance of a Runtime must be able to do the following:

- Commit to Intentions.
- Fulfill those Intentions.

## Intention

According to the [Plan/Fulfillment](../concepts/plan-fulfillment.md) pattern, Intention is a type of Plan.

An Intention instance could be a named object with no data, e.g. SquishableIntention. Another Intention instance might have data, such as `fromValue`, `toValue`, and an `easingCurve`.

{% em type="red" %}Emphasis: recall from [Plan/Fulfillment](../concepts/plan-fulfillment.md) that an Intention (the Plan) must not fulfill itself.{% endem %} The Runtime will determine how to fulfill its provided Intentions.

## Commit Intentions

Intentions are committed to Runtimes via Transactions.

A Transaction's public API should support the following operations:

- Associate an Intention with a target.
- Associate a named Intention with a target.
- Remove any Intention associated with a given name from a target.

It must be possible to enumerate the operations of a Transaction.

The log's order must match the order of operation requests.

A Transaction needs to be committed to a Runtime for it to take effect; e.g. `runtime.commit(transaction)`.

Consider the following transaction pseudo-code:

    transaction = Transaction()
    transaction.add(FadeIn, circleView)
    transaction.add(Draggable, squareView)
    transaction.addNamed("name1", Pinchable, squareView)
    transaction.addNamed("name2", Rotatable, squareView)
    transaction.removeNamed("name2", squareView)
    transaction.add(Draggable, circleView)
    runtime.commit(transaction)

The Transaction's log might resemble the following pseudo-object:

    > transaction.log
    [
      {action:"add", intention: FadeIn, target: circleView},
      {action:"add", intention: Draggable, target: squareView},
      {action:"addNamed", intention: Pinchable, name: "name1", target: squareView},
      {action:"addNamed", intention: Rotatable, name: "name2", target: squareView},
      {action:"remove", name: "name2", target: squareView}
      {action:"add", intention: Draggable, target: circleView},
    ]

After committing the above transaction, the Runtime's internal state might resemble the following:

![](../_assets/TargetManagers.svg)

Note that `Rotatable` is not listed. This is because we also removed any Intention named "name2" in this Transaction.

The Runtime is now expected to fulfill its Intentions.

## Fulfill Intentions

The Runtime we propose uses entities called **Actors** to fulfill specific types of Intention. The Actor is the mediating agent between Intention and its fulfillment.

### Intention ↔ Actor association

We'll assume a function exists that returns an object capable of fulfilling an Intention. We'll call such an object an **executor**. The method signature for this method might look like this:

    function executorForIntention(plan, target, existingActors) -> Actor

This function will use a `Intention type → Actor type` lookup table. The lookup can be implemented in many ways:

**Intention → Actor**

Intentions define the Actor they require. This requires Intentions to be aware of their Actors, which is not ideal. It does, however, avoid a class of problems that exist if Actors can define which Intentions they fulfill.

**Actor → Intention**

Actors define which Intentions they can fulfill. This approach allows Intentions to be less intelligent. It introduces the possibility of Actors conflicting on a given Intention.

### On commit: generate executors

When a Transaction is committed, the Runtime must generate an Actor for each Intention in the Transaction. Consider the Transaction log we'd explored above:

    > transaction.log
    [
      {action:"add", plan: FadeIn, target: circleView},
      {action:"add", plan: Draggable, target: squareView},
      {action:"addNamed", plan: Pinchable, name: "name1", target: squareView},
      {action:"addNamed", plan: Rotatable, name: "name2", target: squareView},
      {action:"remove", name: "name2", target: squareView}
    ]

Recall that the above log translated to the following internal state:

![](../_assets/TargetManagers.svg)

Let's create executors by calling our hypothetical `executorForIntention` on each target's Intentions.

![](../_assets/Actors.svg)

We've created three executors in total. `circleView` has two executors. `squareView` has one. We've also introduced a question to the reader: "Why is there only one gesture executor for the squareView?"

#### One executor per type of Intention

A single executor is created for every type of Intention registered to a target. This allows executors to maintain coherent state even when multiple Intentions are concerned.

Consider the following pseudo-Transaction involving physical simulation Intentions:

    transaction = Transaction()
    transaction.add(Friction.on(position), circleView)
    transaction.add(AnchoredSpring.on(position), circleView)
    runtime.commit(transaction)

Our circleView now has two Intentions and one executor, a PhysicalSimulationActor. Both Intentions are provided to the executor instance.

The executor now knows the following:

- It has two Forces, both affecting `position`.
- It needs to model `velocity` for the `position`.

The executor now creates some state that will track the position's velocity.

The executor can now:

1. convert each Intention into a physics force,
2. apply the force to the velocity, and
3. apply the velocity to the position

on every frame.

Alternatively, consider how this situation would have played out if we had one executor per plan. There would now be two representations of `velocity` for the same `position`. On each frame, one executor would "lose". The result would be a confusing animation.

Note that "one executor per type of Intention" does not resolve the problem of sharing state across different types of Intentions. This is an open problem.

### Repeated: forward animation events to executors

The Runtime is now expected to forward animation events to the executors.

Actors are informed of events via the following pseudo-algorithm:

    for every target
      for every executor
        executor.event()

A Runtime should make reasonable efforts to send relevant events to executors.  For instance: if an executor does not care about the animation event, the Runtime should not inform the executor.

### Runtime active vs idle state

At any given time a Runtime can either be **idle** or **active**.

A Runtime is active when there is at least one active executor.  An executor can be active for any of the following reasons:

- The animate event returned a Boolean value of false.
- The executor has indicated some form of active **external activity**.

### External activity

Actors often depend on external systems to fulfill their Intentions. An Actor is therefor responsible for informing the Runtime of two events:

- When external activity begins.
- When external activity ends.

External activity affects the active state of the Runtime. This can have propagating effects to systems watching the Runtime's current state.

The Runtime can provide executors with two methods:

    var startActivity = function(name)
    var endActivity = function(name)

The name provided to these functions should be scoped to the executor, not globally to the Runtime.

For example, an executor might have a gesture handler that looks like this:

    function handleGesture(gesture) {
      switch (gesture.state) {
      case .Began:
        startActivity("gesture")
      case .Canceled:
      case .Ended:
        endActivity("gesture")
      }
    }

Similarly, an executor might implement the following when working with an external animation system:

    function setup() {
      startActivity("animation")
      target.doAnimation(parameters, completion: {
        endActivity("animation")
      })
    }

### Open topics

The following topics are open for discussion. They do not presently have a clear recommendation.

- When should executors be removed from a Runtime?
