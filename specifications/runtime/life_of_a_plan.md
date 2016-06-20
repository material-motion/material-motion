## Life of a Plan

Let's walk through the life of a Plan.

> Any code you see here is pseudo-code.

### Step 1: Create a Runtime

Runtimes are cheap and easy to create. Many Runtimes may exist in an application. Let's create one.

    runtime = Runtime()

![](../../_assets/LifeOfAPlan-step1.svg)

### Step 2: Create Plans

All motion in a Runtime begins with a Plan. Let's create four different types of Plan:

    animation = Tween()
    animation.property = "opacity"
    animation.from = 0
    animation.to = 1
    
    draggable = Draggable()
    pinchable = Pinchable()
    rotatable = Rotatable()

![](../../_assets/LifeOfAPlan-step2.svg)

### Step 3: Start a transaction and commit it

Let's say we have two targets - a circle and a square - to which we want to associate our plans.

![](../../_assets/LifeOfAPlan-step3-targets.svg)

Plans are associated to targets using a Transaction.

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
      {action:"add",    target: circleView, plan: FadeIn},
      {action:"add",    target: squareView, plan: Draggable},
      {action:"add",    target: squareView, plan: Pinchable, name: "name1"},
      {action:"add",    target: squareView, plan: Rotatable, name: "name2"},
      {action:"remove", target: squareView,                  name: "name2"}
      {action:"add",    target: circleView, plan: Draggable},
    ]

A transaction must be committed to a Runtime in order for it to take affect.

    runtime.commit(transaction)

After committing the above transaction, the Runtime's internal state might resemble the following:

![](../../_assets/TargetManagers.svg)

> Note that `Rotatable` is not listed. This is because we also removed any Plan named "name2" in this Transaction.

The Runtime is now expected to execute its Plans.

### Step 4: Runtime creates Executors

The Runtime uses entities called **Executors** to execute types of Plans. The Executor is the specialized mediating agent between a Plan and its execution.

We'll assume a function exists that returns an Executor capable of executing a type of Plan. The method signature for this method might look like this:

    function executorForPlan(Plan, target, existingExecutors) -> Executor

Recall the transaction log we'd explored above:

    > transaction.log
    [
      {action:"add",    target: circleView, plan: FadeIn},
      {action:"add",    target: squareView, plan: Draggable},
      {action:"add",    target: squareView, plan: Pinchable, name: "name1"},
      {action:"add",    target: squareView, plan: Rotatable, name: "name2"},
      {action:"remove", target: squareView,                  name: "name2"}
      {action:"add",    target: circleView, plan: Draggable},
    ]

The above operations committed to the following internal Runtime state:

![](../../_assets/TargetManagers.svg)

Let's create Executors by calling our hypothetical `executorForPlan` on each target's Plans.

![](../../_assets/Executors.svg)

We've created three Executors in total. `circleView` has two Executors. `squareView` has one. You might be wondering now: "Why is there only one gesture Executor for the squareView?"

A single Executor instance is created for each *type* of Plan registered to a target. This allows Executors to maintain coherent state even when multiple Plans have been committed.

### Step 5: Provide Plans to Executors

The Runtime now provides each Plan instance to the relevant Executor. This allows the Executor to translate specific Plans in to actionable logic.

### Step 6: Executors execute Plans

Executors can implement their Plans in a countless number of ways. Let's focus on two specializations of the Executor type: update execution and remote execution.

**Update execution**

Executors can hook in to the Runtime's update event. The update event fires many times per second and provides some sort of time step. This time step can drive the execution.

**Remote execution**

Some Executors use external systems. For example, an Executor might turn a Plan into an animation object more easily understood by the platform.

The Executor is responsible for informing the Runtime of two things: when remote execution will start, and when remote execution has ended.
