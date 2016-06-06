# Runtimes

The purpose of a Runtime is to enable the **coordination** of interactive motion in an application. A Runtime applies the Plan/Fulfillment and Coordinator/Plan patterns.

A Runtime object is expected to be capable of doing the following:

- Commit to Plans.
- Fulfill Plans.

## Commit Plans

Plans are committed to Runtimes via Transactions.

A Transaction should support the following operations:

- Add Plan to a target.
- Add named Plan to a target.
- Remove named Plan from a target.

A Transaction must maintain an ordered list of operations. This ordered list of operations will be committed to a Runtime.

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

- circleView: [FadeIn]
- squareView: [Draggable], {"name1": Pinchable}

Note that `Rotatable` is not listed. This is because we also removed the named intention for "name2" in this Transaction.

The Runtime is now expected to fulfill its Plans.

## Fulfill Plans

