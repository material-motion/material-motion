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

<p style="text-align:center"><tt>feature: optimized</tt></p>

<p style="text-align:center"><tt>/feature: optimized</tt></p>
