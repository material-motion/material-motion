Status of this document:
![](../../_assets/under-construction-flashing-barracade-animation.gif)

# Executor specification

This is the engineering specification for the Executor object.

Executors are the objects responsible for executing Plan.

---

<p style="text-align:center"><tt>MVP</tt></p>

**Initialize with target**: Executors are initialized with a target.

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

The Executor may choose not to implement this API.

The update event will be called many times per second. The Executor may use this method to perform time-based calculations.

The method returns an activity state enumeration. This enumeration has two states: active and idle.

Example pseudo-code:

    enum ActivityState {
      .Active
      .Idle
    }
    
    protocol UpdateExecuting {
      function update() -> ActivityState
    }

<p style="text-align:center"><tt>/MVP</tt></p>

---

<p style="text-align:center"><tt>feature: Named plans</tt></p>

Executors can receive named Plans.

Example pseudo-code:

    protocol NamedPlanExecuting {
      function addPlan(plan, withName: name)
      function removePlanWithName(name)
    }

<p style="text-align:center"><tt>/feature: Named plans</tt></p>

---
