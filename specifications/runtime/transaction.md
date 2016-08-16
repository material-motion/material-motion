# Transaction specification

This is the engineering specification for the `Transaction` object.

A transaction aggregates requests for plans to be assigned to targets. Transactions are meant to be committed to a [Scheduler](scheduler.md).

Printable tech tree/checklist:

![](../../_assets/TransactionTechTree.svg)

## MVP

**Simple initializer**: A transaction is cheap to create.

Example pseudo-code:

    transaction = Transaction()

**add API**: Provide an API for a basic add operation.

This API must accept a plan and a target object.

Example pseudo-code:

    # Associate a plan with a target.
    transaction.add(plan, target)

**Operation enumeration**: Operations recorded to a transaction are enumerable.

Operations are enumerated in the order in which they were recorded.

**Copying plans**: When a plan is added to a transaction it must be copied. This ensures that subsequent modifications to a plan object do not affect the transaction. For example:

Example pseudo-code:

    plan.fromValue = 0
    transaction.add(plan, target)
    
    plan.fromValue = 5
    transaction.add(plan, target)

Notice that each entry has a different `fromValue` in the following log:

    [
      {action: 'add', plan: {..., fromValue = 0}}, 
      {action: 'add', plan: {..., fromValue = 5}}
    ]

---

<p style="text-align:center"><tt>feature: named associations</tt></p>

Transactions support named add/remove operations.

**Named add API**: Provide an API for `add` and `remove` with a name argument.

Example pseudo-code:

    # Associate a named plan with a target.
    transaction.add(plan, target, name)
    
    # Remove any named plan from a target.
    transaction.remove(name, target)

**Order**: Maintain order of named operations.

Last operation wins.

<p style="text-align:center"><tt>/feature: named operations</tt></p>

---

<p style="text-align:center"><tt>feature: target selector</tt></p>

Transactions may receive target selectors.

**selector APIs**: All add/remove APIs may be provided with a TargetSelector instead of a direct target.

Example pseudo-code:

    # Associate a named plan with a target.
    transaction.add(plan, TargetSelector("#contextView"))
    
    # Remove any named plan from a target.
    transaction.remove(name, TargetSelector("#contextView"))

<p style="text-align:center"><tt>/feature: target selector</tt></p>

---

<p style="text-align:center"><tt>feature: target enumeration</tt></p>

Targets referenced in a transaction are enumerable.

**Order**: Targets are enumerated in the order in which they were first referenced.

Example pseudo-code:

    > transaction.targets
    [
      circleView,
      squareView
    ]

<p style="text-align:center"><tt>/feature: target enumeration</tt></p>

---

<p style="text-align:center"><tt>feature: serialization</tt></p>

Transactions are serializable.

Serializable transactions can be sent over a wire or recorded to disk.

**serialize/deserialize API**: Provide APIs for serializing and deserializing a transaction.

Example pseudo-code:

    # Serialize the transaction
    data = transaction.serialize()
    
    # Create a new transaction from data
    transaction = Transaction(data)

Open questions:

- How do we know which target to associate a given plan with?

Further reading: [Serialization](../serialization.md)

<p style="text-align:center"><tt>/feature: serialization</tt></p>

---

<p style="text-align:center"><tt>feature: optimized</tt></p>

Transactions optimize their operations.

TODO: Spec this out.

<p style="text-align:center"><tt>/feature: optimized</tt></p>
