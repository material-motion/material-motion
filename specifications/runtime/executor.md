# Transactions

Transactions aggregate requests for Plan-target associations. Transactions are designed to be committed to a Runtime.

`v1` **Creation**: Transactions can be created at any time.

    transaction = Transaction()

**Operations**: Transactions should support the following operations.

> Note: the function names included below are not prescriptive. Choose appropriate names for your language/platform conventions.

`v1` operations:

    # Associate a Plan with a target.
    transaction.add(plan, target)

`feature: named` operations:

    # Associate a named Plan with a target.
    transaction.add(plan, name, target)
    
    # Remove any named Plan from a target.
    transaction.remove(name, target)

`v1` **Enumerating operations**: Operations recorded to a transaction must be enumerable.

Operations must enumerate in the exact same order in which they were recorded.

`v1` **Copying Plans**: When a Plan is added to a transaction it must be copied. This ensures that subsequent modifications to the Plan object do not "sneak" in to the transaction. For example:
Status of this document:
![](../../../_assets/under-construction-flashing-barracade-animation.gif)

# Executors

Executors are the objects responsible for executing Plan.

`v1` **Who creates them?**: Runtimes create Executors.

`v1` **When are they created?**: When a transaction is committed.

`v1` **Initialization**: The Runtime initializes the Executor by providing a target instance.

Every other method described below should be **optional** for the Executor.

## Plan

`v1` **Plans**: Plans may be provided to Executors as they're committed to the Runtime.

Example pseudo-API available on the Executor:

    Executor {
      function addPlan(plan)
    }

Example pseudo-code from within the Runtime:

    Executor = ExecutorForPlan(plan)
    Executor.addPlan(plan)

`feature: named` **Named Plans**: Executors may choose to support named Plans. When a named Plan is committed to a target, two things must happen:

1. Remove any previously-committed Plan with the same name from the target's Executors. This may be on a different Executor instance.
2. Provide the relevant Executor with the new named Plan.

Example pseudo-API available on the Executor:

    Executor {
      function addPlan(plan, withName: name)
      function removePlanWithName(name)
    }

Example pseudo-code from within the Runtime:

    # Step 1
    ExecutorForName(name).removePlanWithName(name)
    
    # Step 2
    Executor = ExecutorForPlan(plan)
    Executor.setPlan(plan, withName: name)
    ExecutorForName(name) = Executor

    plan.fromValue = 0
    transaction.add(plan, target)
    
    plan.fromValue = 5
    transaction.add(plan, target)

The transaction's log must look like so:

    [add(plan (fromValue = 0), add(plan (fromValue = 5)]

Note that the first plan's `fromValue` did not magically transform into `5`.

`v1` **Committing**: Transactions must be committed to a Runtime.

    runtime.commit(transaction)

`feature: serialization` **Serialization**: Transactions may be serializable.

Serializable transactions can be sent over a wire or recorded to disk.

`feature: optimized` **Optimizations**: Transactions can optimize their operations.

TODO: Emphasize that it's important that which targets were "poked" by a Transaction is not lost. The Runtime needs this for its "new target" event.
