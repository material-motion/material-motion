# Runtimes

The purpose of a Runtime is to enable the **coordination** of interactive motion in an application. A Runtime applies the Plan/Fulfillment and Coordinator/Plan patterns.

A Runtime object is expected to be capable of doing the following:

- Associate Plans with target instances.
- Fulfill Plans.

## Associating Plans

Plans are registered to Runtimes via Transactions. Transactions allow Runtimes to commit a group of Plans together.

A Transaction should provide the following operations:

- Add Plan to a target.
- Add named Plan to a target.
- Remove named Plan from a target.

Each operation should be stored in an ordered list of operations.

A Transaction can be committed to a Runtime. Example pseudo-code:

    runtime.commit(transaction)

An example of a transaction log that might be committed, in pseudo-code:

    [
      add<FadeIn, circleView>,
      add<Draggable, squareView>
      addNamed<"name1", Pinchable, squareView>
      addNamed<"name2", Rotatable, squareView>
      removeNamed<"name2", squareView>
    ]

After committing the above transaction, our Runtime's internal state might resemble the following:

- circleView: [FadeIn]
- squareView: [Draggable], {"name1": Pinchable}

Note that `Rotatable` is not listed. This is because we removed the named intention for "name2" in this Transaction.

The Runtime is now expected to fulfill the Plans.

## Fulfill Plans
