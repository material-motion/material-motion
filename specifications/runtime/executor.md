# Executor specification

This is the engineering specification for the Executor object.

Executors are the objects responsible for executing Plan.

Printable tech tree/checklist:



---

<p style="text-align:center"><tt>MVP</tt></p>

**Abstract type**: An Executor is an abstract protocol or interface, if your language allows.

Example pseudo-code:

    protocol Executor {
    }

**Not configurable**: Executors do not provide direct configuration methods.

Executors can only be configured by providing them with Plans.

**Initialize with target**: Executors are initialized with a target.

Example pseudo-code:

    executor = Executor(target)

**Add Plans API**: Plans are provided to Executors.

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

**Add/remove API**: Executors can implement an add/remove function.

If one method is implemented, so must the other.

Example pseudo-code:

    protocol NamedPlanExecuting {
      function addPlan(plan, withName: name)
      function removePlanWithName(name)
    }

<p style="text-align:center"><tt>/feature: Named plans</tt></p>

---
