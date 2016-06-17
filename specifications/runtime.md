# Motion Runtime

The system described here emphasizes a separation of plan from its execution. We call it a Motion Runtime, or Runtime for short.

The purpose of a Runtime is to coordinate the expression of diverse types of motion and interaction. It is an abstraction layer between the application engineer and execution systems.

The following diagram shows where the Runtime lives in relation to a platform like iOS.


![](../_assets/Abstraction.svg)

## Overview

A Runtime is an object that requires three other objects:

- Intentions
- Executors
- Transactions

![](../_assets/RuntimeOverview.svg)

Intentions are added to Transactions.

Transactions are committed to Runtimes.

Runtimes create Executors.

Intentions and Executors are best described as abstract protocols. Abstract base classes are a reasonable fall-back. Intentions and Executors represent plan and execution, respectively. 

Transactions and Runtimes are both concrete objects.

### Intention

A plan is represented in the Runtime by an instance of Intention.

Example Intention objects:

- `SquashAndStretch` describes a target squashing and stretching in the direction of its movement.
- `Tween` describes a tween animation.
- `Draggable` describes gestural translation.
- `AnchoredSpring` describes a physical simulation.

Learn more about [Intentions](intentions.md).

### Executors

Executors are objects created by a Runtime. Executors are expected to translate Intention into execution.

Learn more about [Executors](Executors.md).

### Transactions

Transactions are the mechanism by which Intentions are committed to a Runtime.

Learn more about [Transactions](transactions.md).

---

## Life of an Intention

We will now walk through the life of an Intention and its eventual execution.

1. Create a Runtime.
1. Create Intentions.
1. Create a Transaction and commit it to the Runtime.
1. The Runtime creates necessary Executors.
1. The Executors execute their Intentions.

### Step 1: Create a Runtime

Creating a Runtime should be as simple as creating a new instance. Many Runtimes may exist in an application.

    runtime = Runtime()

### Step 2: Create Intentions

All motion in a Runtime begins with an Intention. We'll explore four different types of Intentions:

    animation = Tween()
    animation.property = "opacity"
    animation.from = 0
    animation.to = 1
    
    draggable = Draggable()
    pinchable = Pinchable()
    rotatable = Rotatable()

The four objects created above are Intentions. Each Instance represents a plan of motion to be executed by the Runtime.

### Step 3: Start a transaction and commit it

Intention must be committed to a Runtime via a Transaction. Transactions associate Intention with specific targets.

A transaction's public API should support the following operations:

- Associate an Intention with a target.
- Associate a named Intention with a target.
- Remove any Intention associated with a given name from a target.

It must be possible to enumerate the operations of a Transaction. The log's order must match the order of operation requests.

Consider the following pseudo-code:

    transaction = Transaction()
    transaction.add(animation, circleView)
    transaction.add(draggable, squareView)
    transaction.add(pinchable, "name1", squareView)
    transaction.add(rotatable, "name2", squareView)
    transaction.remove("name2", squareView)
    transaction.add(draggable, circleView)

The Transaction's log might resemble the following pseudo-object:

    > transaction.log
    [
      {action:"add", intention: FadeIn, target: circleView},
      {action:"add", intention: Draggable, target: squareView},
      {action:"add", intention: Pinchable, name: "name1", target: squareView},
      {action:"add", intention: Rotatable, name: "name2", target: squareView},
      {action:"remove", name: "name2", target: squareView}
      {action:"add", intention: Draggable, target: circleView},
    ]

Let's commit the transaction:

    runtime.commit(transaction)

After committing the above transaction, the Runtime's internal state might resemble the following:

![](../_assets/TargetManagers.svg)

Note that `Rotatable` is not listed. This is because we also removed any Intention named "name2" in this Transaction.

The Runtime is now expected to fulfill its Intentions.

### Step 4: Runtime creates Executors

The Motion Runtime we propose uses entities called **Executors** to fulfill specific types of Intentions. The Executor is the specialized mediating agent between an Intention and its execution.

> ***Aside: Intention ↔ Executor association***
>
> We'll assume a function exists that returns an Executor capable of fulfilling a type of Intention. The method signature for this method might look like this:
>
>     function ExecutorForIntention(intention, target, existingExecutors) -> Executor
>
> This function could use an `Intention type → Executor type` look-up table. The look-up could be implemented in many ways:
>
> **Intention → Executor**
>
> Intentions define the Executor they require. This requires Intentions to be aware of their Executors, which is not ideal. It does, however, avoid a class of problems that exist if Executors can define which Intentions they fulfill.
>
> **Executor → Intention**
>
> Executors define which Intentions they can fulfill. This approach allows Intentions to be less intelligent. But it introduces the possibility of Executors conflicting on a given Intention.

When a transaction is committed, the Runtime must generate an Executor for each Intention in the transaction. Consider the transaction log we'd explored above:

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

Let's create Executors by calling our hypothetical `ExecutorForIntention` on each target's Intentions.

![](../_assets/Executors.svg)

We've created three Executors in total. `circleView` has two Executors. `squareView` has one. We've also introduced a question to the reader: "Why is there only one gesture Executor for the squareView?"

#### One Executor instance per Intention type per Target

A single Executor instance is created for each *type* of Intention registered to a target. This allows Executors to maintain coherent state even when multiple Intentions have been committed.

Consider the following pseudo-code transaction involving physical simulation Intentions:

    transaction = Transaction()
    transaction.add(Friction.on(position), circleView)
    transaction.add(AnchoredSpring.on(position), circleView)
    runtime.commit(transaction)

`circleView` now has two Intentions and one Executor, a PhysicalSimulationExecutor. Both Intentions are provided to the Executor instance.

The Executor knows the following:

- It has two forces, both affecting `position`.
- It needs to model `velocity` for the `position`.

The Executor creates some state that will track the position's velocity.

The Executor can now:

1. convert each Intention into a physics force,
2. apply the force to the velocity, and
3. apply the velocity to the position

on every frame.

Alternatively, consider how this situation would have played out if we had one Executor for every Intention. There would now be two conflicting representations of `velocity` for the same `position`. On each frame, one Executor would "lose". The result would be a confusing animation.

> Note that "one Executor per type of Intention" does not resolve the problem of sharing state across different types of Intentions. This is an open problem.

### Step 5: Executors execute Intentions

The Runtime is now expected to forward update events to the Executor instances.

Executors are informed of events via the following algorithm:

    for every target
      for every Executor
        Executor.update()

Some Executors are not interested in update events. Do not inform these Executors of update events. If no Executor requires update events, then the Runtime should not listen to update events.

#### Runtime active vs inactive state

A Runtime has two states: **active** or **inactive**. 

A Runtime is active if there is at least one active Executor. 

An Executor can be active for any of the following reasons:

- The update event returned a Boolean value of true. True indicates that the Executor expects to perform more work on the next update event.
- The Executor has indicated some form of active **external activity**.

##### Remote execution

Executors often depend on external systems to execute their Intentions. An Executor therefore is responsible for informing the Runtime of two events:

- When remote execution begins.
- When remote execution ends.

The Runtime might provide Executors with two function instances:

    var remoteExecutionWillStart = function(name)
    var remoteExecutionDidEnd = function(name)

For example, an Executor might have a gesture handler that looks like this:

    function handleGesture(gesture) {
      switch (gesture.state) {
      case .Began:
        remoteExecutionWillStart("gesture")
      case .Canceled:
      case .Ended:
        remoteExecutionDidEnd("gesture")
      }
    }

Similarly, an Executor might implement the following when working with an external animation system:

    function setup() {
      remoteExecutionWillStart("animation")
      target.doAnimation(parameters, completion: {
        remoteExecutionDidEnd("animation")
      })
    }

**Scope**: The Runtime receiving these events should scope the provided name to the Executor instance.

---

## Open topics

The following topics are open for discussion. They do not presently have a clear recommendation.

- When should Executors be removed from a Runtime?

<!--

LGTM:
- featherless
- markwei

-->
