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

### Plan to Executor association

We'll assume a function exists that returns an object capable of fulfilling a Plan. We'll call such an object an **executor**. The method signature for this method might look like this:

    function executorForPlan(plan, target, existingExecutors) -> Executor

This function will use a `Plan type → Executor type` lookup table. The lookup can be implemented in many ways:

**Plan → Executor**

The simplest way to generate the lookup table is to allow Plans to define which Executor they require. This does not provide the cleanest separation of concerns. It does, however, avoid a class of problems that exist if Executors can define which Plans they fulfill.

**Executor → Plan**

In this approach, Executors register themselves as being capable of fulfilling specific Plans. This approach allows Plans to be less intelligent. It introduces the possibility of conflicting Executors for a given Plan.

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

We've created three executors in total. `circleView` has two executors. `squareView` has one.

### Unique vs common executors

Executors can either be **unique** or **common**.

A unique executor requires **at most** one instance for a given target. This instance will be provided with every relevant Plan for the associated target. Relevant being defined as "a Plan that the executor is able to fulfill".

A common executor can have at **most** one instance for a given target.

When an executor is common

Many Plans can be executed by a single executor entity. For example, the Gesture executor can now change the anchor point of the view exactly once.

### Forwarding events to executors

TODO: Discuss how to store these Plans.
TODO: Discuss how to send events to these Plans.
TODO: Discuss marking some targets as dependent on others and how this affects ordering of event forwarding.