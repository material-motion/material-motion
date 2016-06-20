Status of this document:
![](../../_assets/under-construction-flashing-barracade-animation.gif)

# Transaction specification

This is the engineering specification for the Transaction object.

Transactions aggregate requests for Plan-target associations. Transactions are designed to be committed to a Runtime.

---

<p style="text-align:center"><tt>MVP</tt></p>

**Simple initializer**: A Transaction is cheap to create.

    transaction = Transaction()

**Operations**: Transactions support a basic add operation.

> Note: the function names included below are not prescriptive. Choose appropriate names for your language/platform conventions.

    # Associate a Plan with a target.
    transaction.add(plan, target)

**Enumerating operations**: Operations recorded to a transaction are enumerable.

Operations are enumerated in the order in which they were recorded.

**Enumerating targets**: Targets referenced in a transaction are enumerable.

Targets are enumerated in the order in which they were first referenced.

    > transaction.targets
    [
      circleView,
      squareView
    ]

**Copying Plans**: When a Plan is added to a transaction it must be copied. This ensures that subsequent modifications to the Plan object do not "sneak" in to the transaction. For example:

    plan.fromValue = 0
    transaction.add(plan, target)
    
    plan.fromValue = 5
    transaction.add(plan, target)

The transaction's log must look like so:

    [add(plan (fromValue = 0), add(plan (fromValue = 5)]

Note that the first plan's `fromValue` did not magically transform into `5`.

**Committing**: Transactions must be committed to a Runtime.

    runtime.commit(transaction)

<p style="text-align:center"><tt>/MVP</tt></p>

---

<p style="text-align:center"><tt>feature: named operations</tt></p>

Transactions support named add/remove operations.

    # Associate a named Plan with a target.
    transaction.add(plan, name, target)
    
    # Remove any named Plan from a target.
    transaction.remove(name, target)

Operation order matters for named operations.

<p style="text-align:center"><tt>/feature: named operations</tt></p>

---

<p style="text-align:center"><tt>feature: serialization</tt></p>

Transactions are serializable.

Serializable transactions can be sent over a wire or recorded to disk.

<p style="text-align:center"><tt>/feature: serialization</tt></p>

---

<p style="text-align:center"><tt>feature: optimized</tt></p>

Transactions optimize their operations.

<p style="text-align:center"><tt>/feature: optimized</tt></p>
