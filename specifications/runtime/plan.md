# Plans

A Plan is an object representing **what you want something to do**.

A Plan is the *plan* part of the separation of plan/execution.

Example Plan objects:

- `SquashAndStretch` describes a target squashing and stretching in the direction of its movement.
- `Tween` describes a tween animation.
- `Draggable` describes gestural translation.
- `AnchoredSpring` describes a physical simulation.

**Protocol**: Represent Plans as an abstract protocol, if your language allows.

Pseudo-code example:

    protocol Plan {
    }

`v1` **Configuration**: Plans can have configurable properties.

Pseudo-code example:

    Tween: Plan {
      var fromValue
      var toValue
    }

`v1` **Execution**: Executors execute Plans.

This separation of concerns encourages reusable code.

`feature: serialization` **Serialization**: Plans may be serializable.

Serializable Plans can be sent over a wire or recorded to disk.

**Single Executor per type of Plan per target**: A single Executor instance is created for each *type* of Plan registered to a target. This allows Executors to maintain coherent state even when multiple Plans have been committed.

Consider the following pseudo-code transaction involving physical simulation Plans:

    transaction = Transaction()
    transaction.add(Friction.on(position), circleView)
    transaction.add(AnchoredSpring.on(position), circleView)
    runtime.commit(transaction)

`circleView` now has two Plans and one Executor, a PhysicalSimulationExecutor. Both Plans are provided to the Executor instance.

The Executor knows the following:

- It has two forces, both affecting `position`.
- It needs to model `velocity` for the `position`.

The Executor creates some state that will track the position's velocity.

The Executor can now:

1. convert each Plan into a physics force,
2. apply the force to the velocity, and
3. apply the velocity to the position

on every frame.

Alternatively, consider how this situation would have played out if we had one Executor for every Plan. There would now be two conflicting representations of `velocity` for the same `position`. On each frame, one Executor would "lose". The result would be a confusing animation.

> Note that "one Executor per type of Plan" does not resolve the problem of sharing state across different types of Plans. This is an open problem.
