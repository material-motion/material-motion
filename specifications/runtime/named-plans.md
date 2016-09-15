# Named plans specification

This is the engineering specification for **named plans**. This specification requires the Transaction, Performer, Plan, and Scheduler types.

|                  | Android | Apple |
| ---------------- |:-------:|:-----:|
| MVP milestones | &nbsp; | [Milestone](https://github.com/material-motion/material-motion-runtime-objc/milestone/4) |

## Overview

This feature enables the registration of *named plans* to a scheduler. Named plans can be added and remove by name, enabling fine configuration of a performer's behavior.

Printable tech tree/checklist:

![](../../_assets/NamedPlansTechTree.svg)

Example use case: associating a behavior with a target.

Example pseudo-code:

    # on drag
    transaction1.add(
      name: 'drag', 
      plan: matchLocationOf(cursor), 
      target
    )
    scheduler.commit(transaction1)

    # on release
    transaction2.add(
      name: 'drag', 
      plan: springToLocation(origin), 
      target
    )
    scheduler.commit(transaction2)

## Performer specification

Performers can receive named plans.

**Add/remove API**: Performers can implement an add/remove function.

> Performers may choose not to implement this API.

If one method is implemented, the other must be implemented as well.

Example pseudo-code:

    protocol NamedPlanPerforming {
      function addPlanWithName(plan, name)
      function removePlanWithName(name)
    }

**NamedPlan type**: Provide a NamedPlan type.

Plans must conform to the NamedPlan type in order to indicate that they support being registered as named plans to a transaction.

## Transaction specification

Transactions support named add/remove operations.

**Named add API**: Provide an API for `add` and `remove` with a name argument.

Note that the plan type should be a `NamedPlan`. Motion family designers use this type to indicate which plans support being named.

Example pseudo-code:

    class Transaction {
      function add(plan: NamedPlan, to: Target, withName: String)
      function removePlan(named: String, fromTarget: Target)
    }
    
    # Associate a named plan with a target.
    transaction.add(plan, target, name)
    
    # Remove any named plan from a target.
    transaction.remove(name, target)

**Order**: Maintain order of named operations.

Last operation wins in a given transaction.

# Scheduler specification

Schedulers support named plans. Named plans are plans with a name associated via the transaction.

**Target-scoped names**: Names are scoped to the target.

Imagine there are two targets, Apple and Orange. We can add an Eat plan named "action" to Apple and a Peel plan named "action" to Orange.

**Remove-then-add**: Two things happen when a named plan is committed:

1. Remove any previously committed plan with the same name from the target's performers. 

   _Note:_ This may be on a different performer instance. In the above example, perhaps a PhysicsPerformer is needed for the second transaction, but not for the first.
2. Provide the relevant performer with the new named plan.

Example pseudo-code:

    # Step 1
    performerForName(name).removePlanWithName(name)
    
    # Step 2
    performer = performerForPlan(plan)
    performer.setPlan(plan, withName: name)
    performerForName(name) == performer 
    > true
