# Runtimes

The purpose of a Runtime is to enable the **coordination** of interactive motion in an application. A Runtime is an implementation of the [Plan/Fulfillment](patterns/plan-fulfillment.md) pattern.

A Runtime instance must be capable of doing the following:

- Commit to Plans.
- Fulfill those Plans.

## Commit Plans

Plans are committed to Runtimes via Transactions.

A Transaction's public API should support the following operations:

- Associate a Plan with a target.
- Associate a named Plan with a target.
- Remove any Plan associated with a given name from a target.

Internally, a Transaction must maintain an ordered list of operations. This ordered list of operations must be explicitly committed to a Runtime instance.

Consider the following transaction pseudo-code:

    transaction = Transaction()
    transaction.add(FadeIn, circleView)
    transaction.add(Draggable, squareView)
    transaction.addNamed("name", Pinchable, squareView)
    transaction.addNamed("name", Rotatable, squareView)
    transaction.removeNamed("name", squareView)
    runtime.commit(transaction)

The operation log might resemble the following pseudo-object:

    > transaction.log
    [
      {action:"add", plan: FadeIn, target: circleView},
      {action:"add", plan: Draggable, target: squareView},
      {action:"add", plan: FadeIn, target: circleView},
      {action:"add", plan: FadeIn, target: circleView},
      add<Draggable, squareView>
      addNamed<"name1", Pinchable, squareView>
      addNamed<"name2", Rotatable, squareView>
      removeNamed<"name2", squareView>
    ]

After committing the above transaction, our Runtime's internal state might resemble the following:

    circleView's intentions = [FadeIn]
    squareView's intentions = [Draggable]
    squareView's namedIntentions = {"name1": Pinchable}

Note that `Rotatable` is not listed. This is because we also removed the named intention for "name2" in this Transaction.

The Runtime is now expected to fulfill its Plans.

## Fulfill Plans

