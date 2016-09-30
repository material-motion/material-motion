# Directors

A director is an object created for the purposes of describing motion. Its role is similar to that of the Controller in the Model-View-Controller pattern.

"Director" does not have to be a formal base type; or, put another way, the `TransitionDirector` and `InteractionDirector` that we explore here do not have to share a common sub-class or protocol.

Directors have little — if any — imperative code. Directors prefer to describe motion in terms of declarative plans.

Printable tech tree/checklist:

![](../_assets/DirectorTechTree.svg)

## MVP

**planEmitter API**: A director may be provided with a PlanEmitter instance.

Directors must use a PlanEmitter instance in order to register new plans with a scheduler.

Example pseudo-code definition:

    function setPlanEmitter(PlanEmitter)

**Set up API**: A director implements a `setUp` function. This function will be invoked exactly once.

Example pseudo-code definition:

    function setUp()

Directors are expected to commit plans to `setUp`'s provided transaction .

Example pseudo-code implementation:

    function setUp() {
      planEmitter.addPlan(plan, to: targetA)
      planEmitter.addPlan(plan, to: targetB)
      ...
    }

**No access to the scheduler**: Directors do not have direct access to a scheduler.

The primary goal of this restriction is to minimize the number of novel APIs a director must interact with. A transaction is the preferred bridge between a director and a scheduler.

**Tear down API**: The `tearDown` function, if implemented, is invoked when the director's corresponding scheduler is about to terminate.

Pseudo-code example:

    function tearDown() {
      // Perform any cleanup work
    }

**API invocation order**: The director's methods must be invoked in the following order over the lifetime of the director:

1. `setPlanEmitter`
2. `setUp`
3. `tearDown`
