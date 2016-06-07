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
    runtime.commit(transaction)

The Transaction's log might resemble the following pseudo-object:

    > transaction.log
    [
      {action:"add", plan: FadeIn, target: circleView},
      {action:"add", plan: Draggable, target: squareView},
      {action:"addNamed", plan: Pinchable, name: "name1", target: squareView},
      {action:"addNamed", plan: Rotatable, name: "name2", target: squareView},
      {action:"remove", name: "name2", target: squareView}
    ]

After committing the above transaction, our Runtime's internal state might resemble the following:

![](../_assets/TargetManagers.svg)

Note that `Rotatable` is not listed. This is because we also removed the named intention for "name2" in this Transaction.

The Runtime is now expected to fulfill its Plans.

## Fulfill Plans

A Runtime must translate Plans into executable logic.

We'll assume that a function exists that returns an object capable of fulfilling a Plan. We'll call these objects: **executors**. The method signature for this method might look like this:

    function executorForPlan(plan) -> Object

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

Let's ask each TargetManager to create its executors by calling our hypothetical `executorForPlan` on each Plan.



We now have a collection of executors that are able to fulfill the provided Plans. The object graph of a Runtime implementation might now look like this:

### Storage and retrieval of executors





Constraints:

For a given target, must be able to:

- enumerate all executors in a stable order,

- Certain Plans may desire having one executor per target per Plan. Other Plans may desire having only one executor per target, for any number of Plans.
- Targets can be marked as "dependent" on other targets. This affects order of executors for events.

### Forwarding events to executors

TODO: Discuss how to store these Plans.
TODO: Discuss how to send events to these Plans.
TODO: Discuss marking some targets as dependent on others and how this affects ordering of event forwarding.