Status of this document:
![](../../_assets/under-construction-flashing-barracade-animation.gif)

# Executor specification

This is the engineering specification for the Executor object.

Executors are the objects responsible for executing Plan.

---

<p style="text-align:center"><tt>MVP</tt></p>

**Create on Transaction commit**: Create Executors when a Transaction is committed.

**Initialization**: The Runtime initializes the Executor by providing a target instance.

Example pseudo-code:

    executor = Executor(target)

**Provide Plans**: Provide Plans to Executors as they're committed to the Runtime.

The Executor may choose not to implement this API.

Example pseudo-code:

    protocol PlanExecuting {
      function addPlan(plan)
    }

Example pseudo-code from within the Runtime:

    executor = executorForPlan(plan, target)
    if executor.addPlan {
      executor.addPlan(plan)
    }

<p style="text-align:center"><tt>/MVP</tt></p>

---

<p style="text-align:center"><tt>feature: Named plans</tt></p>

Executors can support named Plans. When a named Plan is committed to a target, two things must happen:

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
