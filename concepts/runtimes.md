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

    circleView's Plans = [FadeIn]
    squareView's Plans = [Draggable]
    squareView's named Plans = {"name1": Pinchable}

Note that `Rotatable` is not listed. This is because we *also* removed the named intention for "name2" in this Transaction.

The Runtime is now expected to fulfill its Plans.

## Fulfill Plans

A Runtime must translate Plans into executable logic.

We'll assume that a function exists that returns an object capable of executing the Plan. We'll call these objects: **runtime children**. The method signature for this method might look like so:

    function runtimeChildForPlan(plan) -> Object

### On commit: generate runtime children

When a Transaction is committed, the Runtime must generate a runtime child for each Plan in the Transaction. Consider the Transaction log we'd explored above:

    > transaction.log
    [
      {action:"add", plan: FadeIn, target: circleView},
      {action:"add", plan: Draggable, target: squareView},
      {action:"addNamed", plan: Pinchable, name: "name1", target: squareView},
      {action:"addNamed", plan: Rotatable, name: "name2", target: squareView},
      {action:"remove", name: "name2", target: squareView}
    ]

Recall that the above log translated to the following set of Plans:

    circleView's Plans = [FadeIn]
    squareView's Plans = [Draggable]
    squareView's named Plans = {"name1": Pinchable}

Let's map `runtimeChildForPlan` to each of our Plans:

    circleView's runtime objects = [runtimeChildForPlan(FadeIn)]
    squareView's runtime objects = [runtimeChildForPlan(Draggable)]
    squareView's named runtime objects = {"name1": runtimeChildForPlan(Pinchable)}

We now have a collection of runtime children that are able to fulfill the provided Plans.

### Storage and retrieval of runtime children

Constraints:

- O(n) enumeration of all children in a consistent order.
- Certain Plans may desire having one runtime child per target per Plan. Other Plans may desire having only one runtime child per target, for any number of Plans.

### Forwarding events to runtime children

TODO: Discuss how to store these Plans.
TODO: Discuss how to send events to these Plans.
TODO: Discuss marking some targets as dependent on others and how this affects ordering of event forwarding.