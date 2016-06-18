## Life of a Plan

Let's walk through the life of a Plan.

### Step 1: Create a Runtime

Runtimes are cheap and easy to create. Many Runtimes may exist in an application.

    runtime = Runtime()

### Step 2: Create Plans

All motion in a Runtime begins with a Plan. Let's create four different types of Plan:

    animation = Tween()
    animation.property = "opacity"
    animation.from = 0
    animation.to = 1
    
    draggable = Draggable()
    pinchable = Pinchable()
    rotatable = Rotatable()

### Step 3: Start a transaction and commit it

Plans must be added to a Transaction. The Transaction can then be committed to a Runtime. Transactions allow Plans to be associated targets.

    transaction = Transaction()
    transaction.add(animation, circleView)
    transaction.add(draggable, squareView)
    transaction.add(pinchable, "name1", squareView)
    transaction.add(rotatable, "name2", squareView)
    transaction.remove("name2", squareView)
    transaction.add(draggable, circleView)

The Transaction's log might resemble the following pseudo-object:

    > transaction.log
    [
      {action:"add", plan: FadeIn, target: circleView},
      {action:"add", plan: Draggable, target: squareView},
      {action:"add", plan: Pinchable, name: "name1", target: squareView},
      {action:"add", plan: Rotatable, name: "name2", target: squareView},
      {action:"remove", name: "name2", target: squareView}
      {action:"add", plan: Draggable, target: circleView},
    ]

We can now commit the transaction:

    runtime.commit(transaction)

After committing the above transaction, the Runtime's internal state might resemble the following:

![](../../_assets/TargetManagers.svg)

> Note that `Rotatable` is not listed. This is because we also removed any Plan named "name2" in this Transaction.

The Runtime is now expected to fulfill its Plans.

### Step 4: Runtime creates Executors

The Runtime uses entities called **Executors** to fulfill specific types of Plans. The Executor is the specialized mediating agent between a Plan and its execution.

We'll assume a function exists that returns an Executor capable of fulfilling a type of Plan. The method signature for this method might look like this:

    function executorForPlan(Plan, target, existingExecutors) -> Executor

The Runtime must generate an Executor for each type of Plan for each target in the transaction. Recall the transaction log we'd explored above:

    > transaction.log
    [
      {action:"add", plan: FadeIn, target: circleView},
      {action:"add", plan: Draggable, target: squareView},
      {action:"addNamed", plan: Pinchable, name: "name1", target: squareView},
      {action:"addNamed", plan: Rotatable, name: "name2", target: squareView},
      {action:"remove", plan: "name2", target: squareView}
    ]

Recall that the above log translated to the following internal state:

![](../../_assets/TargetManagers.svg)

Let's create Executors by calling our hypothetical `executorForPlan` on each target's Plans.

![](../../_assets/Executors.svg)

We've created three Executors in total. `circleView` has two Executors. `squareView` has one. You might be wondering now: "Why is there only one gesture Executor for the squareView?"

A single Executor instance is created for each *type* of Plan registered to a target. This allows Executors to maintain coherent state even when multiple Plans have been committed.

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

### Step 5: Executors execute Plans

The Runtime is now expected to send relevant events to the Executor.

Some Executors require an `update` event. This event is called many times per second. The Executor can apply the perceived change in time to some internal progress
