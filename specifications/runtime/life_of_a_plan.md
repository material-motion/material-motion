## Life of a Plan

This article walks through the life of a Plan and its eventual execution.

1. Create a Runtime.
1. Create Plans.
1. Create a Transaction and commit it to the Runtime.
1. The Runtime creates necessary Executors.
1. The Executors execute their Plans.

### Step 1: Create a Runtime

Creating a Runtime should be as simple as creating a new instance. Many Runtimes may exist in an application.

    runtime = Runtime()

### Step 2: Create Plans

All motion in a Runtime begins with a Plan. We'll explore four different types of Plans:

    animation = Tween()
    animation.property = "opacity"
    animation.from = 0
    animation.to = 1
    
    draggable = Draggable()
    pinchable = Pinchable()
    rotatable = Rotatable()

The four objects created above are Plans. Each Instance represents a plan of motion to be executed by the Runtime.

### Step 3: Start a transaction and commit it

Plan must be committed to a Runtime via a Transaction. Transactions associate Plan with specific targets.

A transaction's public API should support the following operations:

- Associate a Plan with a target.
- Associate a named Plan with a target.
- Remove any Plan associated with a given name from a target.

It must be possible to enumerate the operations of a Transaction. The log's order must match the order of operation requests.

Consider the following pseudo-code:

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

Let's commit the transaction:

    runtime.commit(transaction)

After committing the above transaction, the Runtime's internal state might resemble the following:

![](../../_assets/TargetManagers.svg)

Note that `Rotatable` is not listed. This is because we also removed any Plan named "name2" in this Transaction.

The Runtime is now expected to fulfill its Plans.

### Step 4: Runtime creates Executors

The Motion Runtime we propose uses entities called **Executors** to fulfill specific types of Plans. The Executor is the specialized mediating agent between a Plan and its execution.

> ***Aside: Plan ↔ Executor association***
>
> We'll assume a function exists that returns an Executor capable of fulfilling a type of Plan. The method signature for this method might look like this:
>
>     function ExecutorForPlan(plan, target, existingExecutors) -> Executor
>
> This function could use an `Plan type → Executor type` look-up table. The look-up could be implemented in many ways:
>
> **Plan → Executor**
>
> Plans define the Executor they require. This requires Plans to be aware of their Executors, which is not ideal. It does, however, avoid a class of problems that exist if Executors can define which Plans they fulfill.
>
> **Executor → Plan**
>
> Executors define which Plans they can fulfill. This approach allows Plans to be less intelligent. But it introduces the possibility of Executors conflicting on a given Plan.

When a transaction is committed, the Runtime must generate an Executor for each Plan in the transaction. Consider the transaction log we'd explored above:

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

Let's create Executors by calling our hypothetical `ExecutorForPlan` on each target's Plans.

![](../../_assets/Executors.svg)

We've created three Executors in total. `circleView` has two Executors. `squareView` has one. We've also introduced a question to the reader: "Why is there only one gesture Executor for the squareView?"

#### One Executor instance per Plan type per Target

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

The Runtime is now expected to forward update events to the Executor instances.

Executors are informed of events via the following algorithm:

    for every target
      for every executor
        executor.update()

Some Executors are not interested in update events. Do not inform these Executors of update events. If no Executor requires update events, then the Runtime should not listen to update events.

#### Runtime activity state

A Runtime has two states: **active** or **inactive**. 

A Runtime is active if there is at least one active Executor. 

An Executor can be active for any of the following reasons:

- The update event returned a Boolean value of true. True indicates that the Executor expects to perform more work on the next update event.
- The Executor has indicated some form of active **external activity**.

##### Remote execution

Executors often depend on external systems to execute their Plans. An Executor therefore is responsible for informing the Runtime of two events:

- When remote execution begins.
- When remote execution ends.

The Runtime might provide Executors with two function instances:

    var remoteExecutionWillStart = function(name)
    var remoteExecutionDidEnd = function(name)

For example, an Executor might have a gesture handler that looks like this:

    function handleGesture(gesture) {
      switch (gesture.state) {
      case .Began:
        remoteExecutionWillStart("gesture")
      case .Canceled:
      case .Ended:
        remoteExecutionDidEnd("gesture")
      }
    }

Similarly, an Executor might implement the following when working with an external animation system:

    function setup() {
      remoteExecutionWillStart("animation")
      target.doAnimation(parameters, completion: {
        remoteExecutionDidEnd("animation")
      })
    }

**Scope**: The Runtime receiving these events should scope the provided name to the Executor instance.