# Runtime

This is the engineering specification for the Runtime object.

---

<p style="text-align:center"><tt>MVP</tt></p>

**Simple initializer**: A Runtime should be cheap to create.

Example pseudo-code:

    runtime = Runtime()

**One Executor per type of Plan per target**: A single Executor instance is created for each *type* of Plan registered to a target. This allows Executors to maintain coherent state even when multiple Plans have been committed.

![](../../_assets/OneExecutor.svg)

> Consider the following pseudo-code transaction involving physical simulation:
> 
>     transaction = Transaction()
>     transaction.add(Friction(), circleView)
>     transaction.add(AnchoredSpringAtLocation(x, y), circleView)
>     runtime.commit(transaction)
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

> on every frame.
> 
> Alternatively, consider how this situation would have played out if we had one Executor for every Plan. There would now be two conflicting representations of `velocity` for the same `position`. On each frame, one Executor would "lose". The result would be a confusing animation.

Note that "one Executor per type of Plan" does not resolve the problem of sharing state across different types of Plans. This is an open problem.

**Plan ↔ Executor association**: The Runtime must be able to translate Plans into Executors.

This lookup can be implemented in many ways:

- Plans map to Executor type

Plans define the Executor they require. This requires Plans to be aware of their Executors, which is not ideal. It does, however, avoid a class of problems that exist if Executors can define which Plans they fulfill.

> This is the preferred approach.

- Map Executor to Plan type with lookup table

Executors define which Plans they can fulfill. This approach allows Plans to be less intelligent. But it introduces the possibility of Executors conflicting on a given Plan.

**Event: runtime activity state did change**: Any time the Runtime changes its idle/active state it should fire an observable event.

This event enables "Transition Directors".

`feature: duplication` **Event: new target**: The Runtime should send an event each time a new target is referenced.

The receivers of this event should be allowed to set a new "shadow" instance of the target. The shadow instance will be provided to the Executors.

This event enables "view duplication".

<p style="text-align:center"><tt>/MVP</tt></p>

---

## Experimental ideas

`feature: targetidle` **Event: target activity state did change**: Any time a specific target changes its idle/active state it should fire an observable event.

This event enables reactionary Plans, i.e. registering new Plans once a Target has entered an idle state.

> NOTE: It may be more valuable to have Executor-level idling. Target-level idling may not be helpful. It's unclear how Executor-level idling would work, given that the outside system should generally be unaware of Executors. Perhaps you could use plans as the entry-point:
>
>     transaction.add(plan, target, function() {
>       Executor idle callback
>     })


---

## Open topics

The following topics are open for discussion. They do not presently have a clear recommendation.

- When should Executors be removed from a Runtime?

