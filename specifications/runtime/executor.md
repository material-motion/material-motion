# Performer specification

This is the engineering specification for the Performer abstract type.

Performers are the objects responsible for executing Plans.

Printable tech tree/checklist:

![](../../_assets/PerformerTechTree.svg)

---

<p style="text-align:center"><tt>MVP</tt></p>

**Abstract type**: An Performer is a protocol, if your language has that concept.

Example pseudo-code:

    protocol Performer {
    }

**Not configurable**: Performers do not provide direct configuration methods.

Performers can only be configured by providing them with Plans.

**Initialize with target**: Performers are initialized with a target.

Example pseudo-code:

    executor = Performer(target)

**Add plans API**: Plans are provided to Performers.

>The Performer may choose not to implement this API.

Example pseudo-code:

    protocol PlanExecution {
      function addPlan(plan)
    }

Example pseudo-code from within the Scheduler:

    executor = executorForPlan(plan, target)
    if executor.addPlan {
      executor.addPlan(plan)
    }

**Delegated execution API**: An Performer can choose to delegate its work to a platform-native API, like Web Animations or CoreAnimation.

> If an Performer does not use delegated execution, it does not have to implement this API.

The Performer would be responsible for informing the Runtime of two things: when delegated execution will start, and when delegated execution has ended.

Example pseudo-code if your language does not support anonymous functions:

    protocol DelegatedExecution {
      function setDelegatedExecutionCallback(callback)
    }
    
    class DelegatedExecutionCallback {
      function onDelegatedExecutionStart(executor, name)
      function onDelegatedExecutionEnd(executor, name)
    }

Example pseudo-code if your language supports anonymous functions:

    protocol DelegatedExecution {
      var onDelegatedExecutionStart(executor, name)
      var onDelegatedExecutionEnd(executor, name)
    }

<p style="text-align:center"><tt>/MVP</tt></p>

---

<p style="text-align:center"><tt>feature: Named plans</tt></p>

Performers can receive named Plans.

**Add/remove API**: Performers can implement an add/remove function.

>The Performer may choose not to implement this API.

If one method is implemented, so must the other.

Example pseudo-code:

    protocol NamedPlanExecution {
      function addPlanWithName(plan, name)
      function removePlanWithName(name)
    }

<p style="text-align:center"><tt>/feature: Named plans</tt></p>

---

<p style="text-align:center"><tt>feature: Manual execution</tt></p>

An Performer can choose to implement an update function that will be called many times per second.

**Manual execution API**: Performers can implement an update function.

>The Performer may choose not to implement this API.

The update function will be called each time the platform will draw a new frame. The Performer may use this method to perform time-based calculations.

The method returns an activity state enumeration. This enumeration has two states: active and idle.

Example pseudo-code:

    enum ActivityState {
      .Active
      .Idle
    }
    
    protocol ManualExecution {
      function update(deltaTimeMs) -> ActivityState
    }

<p style="text-align:center"><tt>/feature: Manual execution</tt></p>

---
