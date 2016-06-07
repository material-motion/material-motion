Status of this document: **Drafting by featherless**

# Runtimes

The purpose of a Runtime is to enable the **coordination** of interactive motion in an application. A Runtime is an implementation of the [Plan/Fulfillment](patterns/plan-fulfillment.md) pattern. An instance of a Runtime is a delightful companion to a [Coordinator](patterns/coordinator-plan.md).

A Runtime instance must be able to do the following:

- Commit to Plans.
- Fulfill those Plans.

## Commit Plans

Plans are committed to Runtimes via Transactions.

A Transaction's public API should support the following operations:

- Associate a Plan with a target.
- Associate a named Plan with a target.
- Remove any Plan associated with a given name from a target.
- Enumerate the log of operations.

The log's order must match the order of the requested operations.

A Transaction must be explicitly committed to a Runtime; e.g. `runtime.commit(transaction)`.

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
      {action:"add", plan: FadeIn, target: circleView},
      {action:"add", plan: Draggable, target: squareView},
      {action:"addNamed", plan: Pinchable, name: "name1", target: squareView},
      {action:"addNamed", plan: Rotatable, name: "name2", target: squareView},
      {action:"remove", name: "name2", target: squareView}
      {action:"add", plan: Draggable, target: circleView},
    ]

After committing the above transaction, our Runtime's internal state might resemble the following:

![](../_assets/TargetManagers.svg)

Note that `Rotatable` is not listed. This is because we also removed the named intention for "name2" in this Transaction.

The Runtime is now expected to fulfill its Plans.

## Fulfill Plans

A Runtime must translate Plans into executable logic.

### Plan ↔ Executor association

We'll assume a function exists that returns an object capable of fulfilling a Plan. We'll call such an object an **executor**. The method signature for this method might look like this:

    function executorForPlan(plan, target, existingExecutors) -> Executor

This function will use a `Plan type → Executor type` lookup table. The lookup can be implemented in many ways:

**Plan → Executor**

Plans define the Executor they require. This requires Plans to be aware of their Executors, which is not ideal. It does, however, avoid a class of problems that exist if Executors can define which Plans they fulfill.

**Executor → Plan**

Executors define which Plans they can fulfill. This approach allows Plans to be less intelligent. It introduces the possibility of Executors conflicting on a given Plan.

### On commit: generate executors

When a Transaction is committed, the Runtime must generate an executor for each Plan in the Transaction. Consider the Transaction log we'd explored above:

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

Let's create executors by calling our hypothetical `executorForPlan` on each target's Plans.

![](../_assets/Executors.svg)

We've created three executors in total. `circleView` has two executors. `squareView` has one. We've also introduced a question to the reader: "Why is there only one gesture executor for the squareView?"

### Executor state

Executors are expected to fulfill specific types of Plans. On a given target, only one instance of an executor is created per type of Plan. This allows executors to share state across many Plans.

One practical benefit of this approach is for physical simulation. Let's say we have two Plans representing Friction and an Anchored Spring, respectively. Both Plans are associated with the target's `position` property. An executor for such Plans must store additional state in order to perform the physical simulations. This additional state is the velocity.

If every instance of a Plan has its own executor, each executor would end up creating its own interpretation of the velocity. The net result would be a confusing physical simulation.

What if each Plan is provided to a single executor? The executor can now know to only create one representation of velocity. It can also sum the two forces and apply them to the velocity in one step.

### Forwarding events to executors

TODO: Discuss how to store these Plans.
TODO: Discuss how to send events to these Plans.
TODO: Discuss marking some targets as dependent on others and how this affects ordering of event forwarding.