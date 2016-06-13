Status of this document: **Draft**

# Motion Runtime

The system we propose here emphasizes a separation of plan from its execution. We call it a Motion Runtime.

The purpose of a Motion Runtime is to coordinate the expression of diverse types of motion and interaction. It is an abstraction layer between the application engineer and execution systems.

The following diagram shows where the Motion Runtime lives in relation to a platform like iOS.

![](../_assets/Abstraction.svg)

Let's zoom in to the Motion Runtime for a moment. Core Animation is just another form of the plan/execution separation. In this case, our Runtime has interpreted the "fadeIn" intention as being executable by Core Animation. The Runtime has composed its execution out to another system (a common pattern we'll make great use of).

![](../_assets/AbstractionDive.svg)

## Overview

A Motion Runtime relies on objects called Intentions.

### Intention

An instance of Intention represents a plan of motion.

**Example objects**:

- `SquashAndStretch` describes a target squashing and stretching in the direction of its movement.
- `Tween` describes a tween animation.
- `Draggable` describes gestural translation.
- `AnchoredSpring` describes a physical simulation.

**Configuration**: Intentions can have configurable properties.

**Portability**: Intentions should be encodable. An Intention should be transferable over a network and to/from permanent storage.

Intentions are executed by Actors.

### Actors

Actors are objects created by a Runtime for the purposes of translating Intention into execution.

---

## Life cycle of an Intention

We will now walk through the life cycle of an Intention and its eventual execution.

1. Create a Runtime.
1. Create Intention.
1. Start a transaction and commit it.
1. The Runtime creates necessary Actors.
1. The Actors execute their Intentions.

### Step 1: Create a Runtime

Creating a Runtime should be as simple as creating a new instance. Many Runtimes may exist in an application.

    runtime = Runtime()

### Step 2: Create Intention

All motion in a Runtime begins with Intention. We'll explore four different types of Intention:

    animation = Tween()
    animation.property = "opacity"
    animation.from = 0
    animation.to = 1
    
    draggable = Draggable()
    pinchable = Pinchable()
    rotatable = Rotatable()

The four objects created above are Intentions. Each Instance represents a plan of motion to be executed by the Runtime.

### Step 3: Start a transaction and commit it

Intention must be committed to a Runtime via a Transaction. Transactions associated Intention with specific targets.

A transaction's public API should support the following operations:

- Associate an Intention with a target.
- Associate a named Intention with a target.
- Remove any Intention associated with a given name from a target.

It must be possible to enumerate the operations of a Transaction. The log's order must match the order of operation requests.

Consider the following pseudo-code:

    transaction = Transaction()
    transaction.add(animation, circleView)
    transaction.add(draggable, squareView)
    transaction.addNamed("name1", pinchable, squareView)
    transaction.addNamed("name2", rotatable, squareView)
    transaction.removeNamed("name2", squareView)
    transaction.add(draggable, circleView)

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

Let's commit the transaction:

    runtime.commit(transaction)

After committing the above transaction, the Runtime's internal state might resemble the following:

![](../_assets/TargetManagers.svg)

Note that `Rotatable` is not listed. This is because we also removed any Intention named "name2" in this Transaction.

The Runtime is now expected to fulfill its Intentions.

### Step 4: Runtime creates Actors

The Motion Runtime we propose uses entities called **Actors** to fulfill specific types of Intention. The Actor is the specialized mediating agent between Intention and its execution.

---

#### Aside: Intention ↔ Actor association

We'll assume a function exists that returns an Actor capable of fulfilling a type of Intention. The method signature for this method might look like this:

    function actorForIntention(intention, target, existingActors) -> Actor

This function will use a `Intention type → Actor type` lookup table. The lookup can be implemented in many ways:

**Intention → Actor**

Intentions define the Actor they require. This requires Intentions to be aware of their Actors, which is not ideal. It does, however, avoid a class of problems that exist if Actors can define which Intentions they fulfill.

**Actor → Intention**

Actors define which Intentions they can fulfill. This approach allows Intentions to be less intelligent. It introduces the possibility of Actors conflicting on a given Intention.

---

When a transaction is committed, the Runtime must generate an Actor for each Intention in the transaction. Consider the transaction log we'd explored above:

    > transaction.log
    [
      {action:"add", intention: FadeIn, target: circleView},
      {action:"add", intention: Draggable, target: squareView},
      {action:"addNamed", intention: Pinchable, name: "name1", target: squareView},
      {action:"addNamed", intention: Rotatable, name: "name2", target: squareView},
      {action:"remove", intention: "name2", target: squareView}
    ]

Recall that the above log translated to the following internal state:

![](../_assets/TargetManagers.svg)

Let's create Actors by calling our hypothetical `actorForIntention` on each target's Intentions.

![](../_assets/Actors.svg)

We've created three Actors in total. `circleView` has two Actors. `squareView` has one. We've also introduced a question to the reader: "Why is there only one gesture Actor for the squareView?"

---

#### Aside: One Actor instance per type of Intention

A single Actor instance is created for each *type* of Intention registered to a target. This allows Actors to maintain coherent state even when multiple Intentions are concerned.

Consider the following pseudo-Transaction involving physical simulation Intentions:

    transaction = Transaction()
    transaction.add(Friction.on(position), circleView)
    transaction.add(AnchoredSpring.on(position), circleView)
    runtime.commit(transaction)

Our circleView now has two Intentions and one Actor, a PhysicalSimulationActor. Both Intentions are provided to the Actor instance.

The Actor now knows the following:

- It has two Forces, both affecting `position`.
- It needs to model `velocity` for the `position`.

The Actor now creates some state that will track the position's velocity.

The Actor can now:

1. convert each Intention into a physics force,
2. apply the force to the velocity, and
3. apply the velocity to the position

on every frame.

Alternatively, consider how this situation would have played out if we had one Actor per Intention. There would now be two representations of `velocity` for the same `position`. On each frame, one Actor would "lose". The result would be a confusing animation.

Note that "one Actor per type of Intention" does not resolve the problem of sharing state across different types of Intentions. This is an open problem.

---

### Step 5: Actors execute Intention.

The Runtime is now expected to forward animation events to the Actor instances.

Actors are informed of events via the following algorithm:

    for every target
      for every actor
        actor.event()

Some Actors are not interested in animation events. Do not inform these Actors of animation events. If no Actor requires animation events, then the Motion Runtime should not listen to animation events.

### Motion Runtime active vs idle state

At any given time a Motion Runtime can either be **idle** or **active**.

A Motion Runtime is active when there is at least one active Actor. 

An Actor can be active for any of the following reasons:

- The animate event returned a Boolean value of true. True indicates that the Actor expects to perform more work on the next animate event.
- The Actor has indicated some form of active **external activity**.

### External activity

Actors often depend on external systems to fulfill their Intentions. An Actor is therefor responsible for informing the Motion Runtime of two events:

- When external activity begins.
- When external activity ends.

The Motion Runtime might provide Actors with two function instances:

    var startActivity = function(name)
    var endActivity = function(name)

When an Actor calls these methods, the provided name should be scoped to the Actor instance, not globally to the Motion Runtime.

For example, an Actor might have a gesture handler that looks like this:

    function handleGesture(gesture) {
      switch (gesture.state) {
      case .Began:
        startActivity("gesture")
      case .Canceled:
      case .Ended:
        endActivity("gesture")
      }
    }

Similarly, an Actor might implement the following when working with an external animation system:

    function setup() {
      startActivity("animation")
      target.doAnimation(parameters, completion: {
        endActivity("animation")
      })
    }

### Open topics

The following topics are open for discussion. They do not presently have a clear recommendation.

- When should Actors be removed from a Motion Runtime?

<!--

LGTM:
- featherless

-->
