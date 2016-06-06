# Runtimes

The purpose of a Runtime is to enable the **coordination** of interactive motion in an application. A Runtime applies the Plan/Fulfillment and Coordinator/Plan patterns.

Throughout this chapter we will apply a metaphor oriented around theater terminology. The metaphor consists primarily of **Intentions** and **Actors**. Actors fulfill Intention (the plan). Both are objects.

A Runtime object is capable of doing the following:

- Associate Intention instances with target instances.
- Create Actor instances that are able to fulfill the provided Intentions.
- Feed events to Actor instances.
- Delegate events to external systems.

## Associating Intentions

Intentions are registered to Runtimes via Transactions. Transactions allow Runtimes to commit a group of Intentions together.

A Transaction should provide the following operations:

- Add Intention to a target.
- Add named Intention to a target.
- Remove named Intention from a target.

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

The Runtime is now expected to create the necessary Actors required to fulfill the Intentions.

## Creating Actors



## Events

## Delegating events
