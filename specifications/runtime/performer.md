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
