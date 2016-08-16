# Performer specification

This is the engineering specification for the `Performer` abstract type.

Performers are the objects responsible for executing plans.

Printable tech tree/checklist:

![](../../_assets/PerformerTechTree.svg)

## MVP

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

**Delegated execution API**: Define an optional API that allows performers to delegate their work to an external system, like Web Animations or CoreAnimation.

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

<p id="composition" style="text-align:center"><tt>feature: Composition</tt></p>

Performers can emit transactions. This is a type of composition.

**transactionEmitter API**: A performer may be provided with a transaction emitter object.

A transaction emitter declaration might look like so:

    protocol TransactionEmitter {
      func emit(transaction: Transaction)
    }

A performer can be provided with a transaction emitter.

Example pseudo-code protocol that a performer could conform to:

    protocol ComposablePerforming {
      func set(transactionEmitter: TransactionEmitter)
    }

Pseudo-code of a performer emitting new plans:

    function onGesture(gesture) {
      if gesture.state == Ended {
        let transaction = Transaction()
        transaction.add(plan: Spring(), to: self)
        self.emitter.emit(transaction)
      }
    }

<p style="text-align:center"><tt>/feature: Composition</tt></p>

---
