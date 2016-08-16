# Scheduler named plans specification

*Related specifications: [Performer named plans](performer-named-plans.md).*

Schedulers support named plans. Named plans are plans with a name associated via the transaction.

Example use case: associating "behavior" with a target.

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

**Target-scoped names**: Names are scoped to the target.

**Remove-then-add**: Two things must happen when a named plan is committed:

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
