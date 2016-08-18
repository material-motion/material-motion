# Performer specification

This is the engineering specification for the `Performer` abstract type.

Performers are the objects responsible for executing plans.

Printable tech tree/checklist:

![](../../_assets/PerformerTechTree.svg)

---

<p style="text-align:center"><tt>MVP</tt></p>

**Abstract type**: `Performer` is a protocol, if your language has that concept.

Example pseudo-code:

    protocol Performer {
    }

**Not directly configurable**: Performers do not provide direct configuration methods.

Performers can only be configured by providing them with plans.

**Initialize with target**: Performers are initialized with a target.

Example pseudo-code:

    performer = Performer(target)

**Add plan API**: Define an optional API that allows performers to receive plans.

> If a performer cannot be configured, it will not expose this API.

Example pseudo-code:

    protocol PlanPerforming {
      function addPlan(plan)
    }

**Delegated execution API v1**: Define an optional API that allows performers to delegate their work to an external system, like Web Animations or CoreAnimation.

> The performer may choose not to implement this API.

The performer would be responsible for informing of two things: when delegated execution will start, and when delegated execution has ended.

Example pseudo-code if your language does not support anonymous functions:

    protocol DelegatingPerformer {
      function setDelegatedExecutionCallback(callback)
    }
    
    class DelegatedExecutionCallback {
      function delegatedExecutionWillStart(performer, planName)
      function delegatedExecutionDidFinish(performer, planName)
    }

Example pseudo-code if your language supports anonymous functions:

    protocol DelegatedExecution {
      var delegatedExecutionWillStart(performer, planName)
      var delegatedExecutionDidFinish(performer, planName)
    }

<a name="delegationv2"></a>

**Delegated execution API v2 (draft)**: Define an optional API that allows performers to delegate their work to an external system, like Web Animations or CoreAnimation.

> The performer may choose not to implement this API.

The performer would be responsible for informing of two things: when delegated execution will start, and when delegated execution has ended.

Example pseudo-code:

    protocol DelegatingPerformer {
      function setDelegatedExecutionCallback(callback)
    }
    
    class DelegatedExecutionCallback {
      function delegatedExecutionWillStart(performer) -> DelegatedPerformanceToken
      function delegatedExecutionDidFinish(performer, token)
    }

In English: the performer must implement a method that receives two functions. Invoking the first function indicates that some unit of delegated work will begin. This function returns a token. The second function must be invoked once the delegated work has completed. Provide the token returned by the first function to this second function.

<p style="text-align:center"><tt>/MVP</tt></p>

---

<p style="text-align:center"><tt>feature: Named plans</tt></p>

Performers can receive named plans.

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

**Manual execution API**: Define an optional API that allows performers to implement an update function.

> The Performer may choose not to implement this API.

The update function will be called each time the platform will draw a new frame. The performer may use this method to perform time-based calculations. The performer is **not** expected to perform any rendering during this update event.

The method returns an activity state enumeration. This enumeration has two states: active and at rest.

Example pseudo-code:

    enum ActivityState {
      .Active
      .AtRest
    }
    
    protocol ManuallyExecutingPerformer {
      function update(millisecondsSinceLastUpdate) -> ActivityState
    }

<p style="text-align:center"><tt>/feature: Manual execution</tt></p>

---
