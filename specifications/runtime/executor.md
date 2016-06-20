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

**Update event**: Executors can implement an update function.

The update function will be called as part of the Runtime's update event.

Example pseudo-code:

    protocol UpdateExecuting {
      function update() -> Boolean
    }

The update function is expected to return a Boolean value. A return value of true indicates that the Executor is active. A return value of false indicates that the Executor is idle.

<p style="text-align:center"><tt>/MVP</tt></p>

---

<p style="text-align:center"><tt>feature: Named plans</tt></p>

Executors can receive named Plans.

Example pseudo-code:

    protocol NamedPlanExecuting {
      function addPlan(plan, withName: name)
      function removePlanWithName(name)
    }

When a named Plan is committed to a target, two things must happen:

1. Remove any previously-committed Plan with the same name from the target's Executors. This may be on a different Executor instance.
2. Provide the relevant Executor with the new named Plan.

Example pseudo-code from within the Runtime:

    # Step 1
    ExecutorForName(name).removePlanWithName(name)
    
    # Step 2
    Executor = ExecutorForPlan(plan)
    Executor.setPlan(plan, withName: name)
    ExecutorForName(name) = Executor

<p style="text-align:center"><tt>/feature: Named plans</tt></p>

---
