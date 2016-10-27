# Director

| Discussion thread | Status |
|:------------------|:-------|
| ![](../../_assets/under-construction-flashing-barracade-animation.gif) | Drafting as of Oct 25, 2016 |

A director is an object whose primary purpose is to describe motion.

## Overview

"Director" does not have to be a formal base type. An object that emits Plans across a variety of targets can be considered a Director.

Directors have little — if any — imperative code that directly applies changes to targets. Directors prefer to describe motion indirectly via plans. Directors may have a large amount of imperative code that coordinates the registration of plans.

## MVP

**planEmitter API**: A director may be provided with a PlanEmitter instance.

Directors must use a PlanEmitter instance in order to register new plans with a scheduler.

Example pseudo-code definition:

```
function setPlanEmitter(PlanEmitter)
```

**setUp API**: A director implements a `setUp` function. This function will be invoked exactly once.

Example pseudo-code definition:

```
function setUp()
```

Directors are expected to commit plans to `setUp`'s provided transaction .

Example pseudo-code implementation:

```
function setUp() {
  planEmitter.addPlan(plan, to: targetA)
  planEmitter.addPlan(plan, to: targetB)
  ...
}
```

**Tear down API**: The `tearDown` function, if implemented, is invoked when the director's corresponding scheduler is about to terminate.

Pseudo-code example:

```
function tearDown() {
  // Perform any cleanup work
}
```

**API invocation order**: The director's methods must be invoked in the following order over the lifetime of the director:

1. `setPlanEmitter`
2. `setUp`
3. `tearDown`

**No access to a scheduler**: Directors do not have direct access to a scheduler.

The primary goal of this restriction is to minimize the number of novel APIs a director must interact with. The planEmitter is the preferred bridge between a director and its scheduler.

