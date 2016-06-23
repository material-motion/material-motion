# Scheduler specification

This is the engineering specification for the Scheduler object.

A Scheduler accepts Transactions and creates Executors. The Scheduler generates relevant events for Executors and observers and monitors activity.


Printable tech tree/checklist:

![](../../_assets/SchedulerTechTree.svg)

---

<p style="text-align:center"><tt>MVP</tt></p>

**Simple initializer**: A Scheduler is cheap to create.

Example pseudo-code:

    scheduler = Scheduler()

**commit API**: Provide an API to commit Transactions to a scheduler.

Example pseudo-code:

    scheduler.commit(transaction)

Requires: [Transaction](transaction.md)

**One instance of an Executor type per target**: Create One Executor instance for each *type* of Executor required by a target. This allows multiple Plans to affect a single Executor instance. The Executors can then maintain state across multiple Plans.

![](../../_assets/OneExecutor.svg)

> Consider the following pseudo-code transaction involving physical simulation:
> 
>     transaction = Transaction()
>     transaction.add(Friction(), circleView)
>     transaction.add(AnchoredSpringAtLocation(x, y), circleView)
>     scheduler.commit(transaction)
> 
> `circleView` now has two Plans and one Executor, a PhysicalSimulationExecutor. Both Plans are provided to the Executor instance.
> 
> The Executor knows the following:
> 
> - It has two forces, both affecting `position`.
> - It needs to model `velocity` for the `position`.
> 
> The Executor creates some state that will track the position's velocity.
> 
> The Executor can now:
> 
> 1. convert each Plan into a physics force,
> 2. apply the force to the velocity, and
> 3. apply the velocity to the position
>
> on every update event.
> 
> Alternatively, consider how this situation would have played out if we had one Executor for each Plan. There would now be two conflicting representations of `velocity` for the same `position`. On each frame, one Executor would "lose". The result would be a confusing animation.

Note that "one Executor per type of Plan" does not resolve the problem of sharing state across different types of Plans. This is an open problem.

**Plan ↔ Executor association**: The scheduler must be able to translate Plans into Executors.

This lookup can be implemented in many ways:

- Plans define their Executor type

  This requires Plans to be aware of their Executors, which is not ideal. It does, however, avoid a class of problems that exist if Executors can define which Plans they fulfill.
  
  > This is the simpler approach, and may be used for MVPs.
  
  Example pseudo-code:
  
      class SomePlan {
        function executorType() {
          return SomeExecutor.type
        }
      }
      
      # In the scheduler...
      executorType = plan.executorType()
      executor = executorType()

- Map Executor type to Plan type with look-up table

  Executors define which Plans they can fulfill. This approach allows Plans to be less intelligent. But it introduces the possibility of Executors conflicting on a given Plan.  The scheduler would need to be able to determine which one to use.
  
  Example pseudo-code:
  
      # In some initialization step...
      scheduler.executorType(SomeExecutor.type, canExecutePlanType: SomePlan.type)
      
      # In the scheduler...
      executorType = plan.executorTypeForPlan(plan)
      executor = executorType()

**Activity state**: Activity state is one of either active or idle. The scheduler must provide a read-only API for accessing this state.

Pseudo-code example:

    enum ActivityState {
      .Active
      .Idle
    }
    
    Scheduler {
      function activityState() -> ActivityState
    }

A scheduler is active if any of its Executor instances are active.

<p style="text-align:center"><tt>/MVP</tt></p>

---

<p style="text-align:center"><tt>feature: activity state change event</tt></p>

Fire an observable event when the idle/active state changes.

Unlocks [Transition Directors](../transition_directors.md).

**activity state changed API**: Provide a mechanism for listening to activity state changes.

    Scheduler {
      function addActivityStateObserver(function)
    }
    
    scheduler.addActivityStateObserver(function(newState) {
      // React to state change
    })

**Many observers**: Allow many observers to be registered.

<p style="text-align:center"><tt>/feature: activity state change event</tt></p>

---

<p style="text-align:center"><tt>feature: named plans</tt></p>

Schedulers support named Plans. Named Plans are plans with a name associated via the Transaction.

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

**Remove-then-add**: Two things must happen when a named Plan is committed:

1. Remove any previously-committed Plan with the same name from the target's Executors. 

   _Note:_ This may be on a different Executor instance.  In the above example, perhaps a PhysicsExecutor is needed for the second transaction, but not for the first.
2. Provide the relevant Executor with the new named Plan.

Example pseudo-code:

    # Step 1
    executorForName(name).removePlanWithName(name)
    
    # Step 2
    executor = executorForPlan(plan)
    executor.setPlan(plan, withName: name)
    executorForName(name) == executor 
    > true

<p style="text-align:center"><tt>/feature: named plans</tt></p>

---

<p style="text-align:center"><tt>feature: new target event</tt></p>

Fire an observable event when a new target is referenced.

Unlocks [view duplication](../view_duplication.md).

**new target API**: Provide a mechanism for listening to new target references.

    Scheduler {
      function addNewTargetObserver(function)
    }
    
    scheduler.addNewTargetObserver(function(target) {
      // Potentially clone the target
      return clonedTarget
    })

**Placeholders**: Allow the event receiver to return a new placeholder instance.

A placeholder instance is meant to be used in place of the original target.

One common use of this feature is *view duplication*. In this implementation, a visual duplicate of the view is created. This duplicate view can be modified with little consequence.

Executors are expected to act on the placeholder instance rather than the original target.

<p style="text-align:center"><tt>/feature: new target event</tt></p>

---

## Experimental ideas

**Event: target activity state did change**: Any time a specific target changes its idle/active state it should fire an observable event.

This is a more focused event than the "scheduler activity state did change".

This event enables reactionary Plans, i.e. registering new Plans once a Target has entered an idle state.

    Transaction {
      function addActivityStateObserverForTarget(target, function)
    }
    
    transaction.addActivityStateObserverForTarget(target, function(newState) {
      // Start a new transaction and commit it to the scheduler...
    })

NOTE: It may be more valuable to have Executor-level idling. Target-level idling may not be helpful. It's unclear how Executor-level idling would work, given that the outside system should generally be unaware of Executors.

    Transaction {
      function addActivityStateObserverForPlan(plan, function)
    }
    
    transaction.addActivityStateObserverForPlan(plan, function(newState) {
      // Start a new transaction and commit it to the scheduler...
    })

---

## Open topics

The following topics are open for discussion. They do not presently have a clear recommendation.

- When should Executors be removed from a scheduler?
- Should schedulers support target-less Plans?

### Proposed features

**Tear down API**: Provide an API to tear down a scheduler.

This API would terminate all active executors and remove all registered Plans.

It's unclear if this is a necessary feature at this point in time.

Example pseudo-code:

    scheduler.tearDown()
