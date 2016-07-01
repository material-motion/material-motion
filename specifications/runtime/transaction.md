# Transaction specification

This is the engineering specification for the `Transaction` object.

A transaction aggregates requests for plans to be assigned to targets. Transactions are meant to be committed to a [Scheduler](scheduler.md).

Printable tech tree/checklist:

![](../../_assets/TransactionTechTree.svg)

Unlocks: [Scheduler](scheduler.md).

---

<p style="text-align:center"><tt>MVP</tt></p>

**Simple initializer**: A transaction is cheap to create.

Example pseudo-code:

    transaction = Transaction()

**Add operation API**: Provide an API for a basic add operation.

This API must accept a plan and a target object.

Example pseudo-code:

    # Associate a plan with a target.
    transaction.add(plan, target)

**Operation enumeration**: Operations recorded to a transaction are enumerable.

Operations are enumerated in the order in which they were recorded.

**Copying plans**: When a plan is added to a transaction it must be copied. This ensures that subsequent modifications to the plan object do not "sneak" in to the transaction. For example:

Example pseudo-code:

    plan.fromValue = 0
    transaction.add(plan, target)
    
    plan.fromValue = 5
    transaction.add(plan, target)

Here's the log.  Notice that each entry has a different `fromValue`.

    [
      {action: 'add', plan: {..., fromValue = 0}}, 
      {action: 'add', plan: {..., fromValue = 5}}
    ]

<p style="text-align:center"><tt>/MVP</tt></p>

---

<p style="text-align:center"><tt>feature: named operations</tt></p>

Transactions support named add/remove operations.

**Named operations API**: Provide an API for add and remove with a name argument.

Example pseudo-code:

    # Associate a named plan with a target.
    transaction.add(plan, name, target)
    
    # Remove any named plan from a target.
    transaction.remove(name, target)

**Order**: Operation order also matters for named operations.

Store named operations in the same log as unnamed operations.

<p style="text-align:center"><tt>/feature: named operations</tt></p>

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
    json = transaction.serialize()
    
    # Create a new transaction from json
    transaction = Transaction(json)

**JSON serialization**: A serialized transaction is represented in JSON.

Further reading: [Serialization](../serialization.md)

<p style="text-align:center"><tt>/feature: serialization</tt></p>

---

<p style="text-align:center"><tt>feature: optimized</tt></p>

Transactions optimize their operations.

TODO: Spec this out.

<p style="text-align:center"><tt>/feature: optimized</tt></p>

<!--

LGTM:
- appsforartists

-->
