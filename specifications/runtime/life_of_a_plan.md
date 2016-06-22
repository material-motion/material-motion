## Life of a Plan

Let's walk through the life of a Plan.

>Remember, any code you see here is pseudo-code.

### Step 1: Create a Scheduler

Schedulers are cheap and easy to create. Many Schedulers may exist in an application. Let's create one.

    Scheduler = Scheduler()

![](../../_assets/LifeOfAPlan-step1.svg)

### Step 2: Create Plans

All motion in a Scheduler begins with a Plan. Let's create four different types of Plan:

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

First we must create a Transaction.

    transaction = Transaction()

Plans are associated to targets via the transaction.

    transaction.add(animation, circleView)
    transaction.add(draggable, squareView)
    transaction.add(pinchable, "name1", squareView)
    transaction.add(rotatable, "name2", squareView)
    transaction.remove("name2", squareView)
    transaction.add(draggable, circleView)

The transaction's log might resemble this:

    > transaction.log
    [
      {action:'add",    target: circleView, plan: FadeIn                  },
      {action:'add",    target: squareView, plan: Draggable               },
      {action:'add",    target: squareView, plan: Pinchable, name: "name1"},
      {action:'add",    target: squareView, plan: Rotatable, name: "name2"},
      {action:'remove", target: squareView,                  name: "name2"},
      {action:'add",    target: circleView, plan: Draggable               },
    ]


A transaction must be committed to a Scheduler in order for it to take affect.

    Scheduler.commit(transaction)

After committing the above transaction, the Scheduler's internal state might resemble this:

![](../../_assets/TargetManagers.svg)

> Note that `Rotatable` is not listed. This is because we also removed any Plan named "name2" in this Transaction.

The Scheduler is now expected to execute its Plans.

### Step 4: Scheduler creates Executors

The Scheduler uses entities called **Executors** to execute Plans. The Executor is the specialized mediating agent between a Plan and its execution.

We'll assume a function exists that returns an Executor capable of executing a type of Plan. The method signature for this method might look like this:

    function executorForPlan(Plan, target, existingExecutors) -> Executor

Recall the transaction log we'd explored above:

    > transaction.log
    [
      {action:'add",    target: circleView, plan: FadeIn                  },
      {action:'add",    target: squareView, plan: Draggable               },
      {action:'add",    target: squareView, plan: Pinchable, name: "name1"},
      {action:'add",    target: squareView, plan: Rotatable, name: "name2"},
      {action:'remove", target: squareView,                  name: "name2"},
      {action:'add",    target: circleView, plan: Draggable               },
    ]

The above operations committed to the following internal Scheduler state:

![](../../_assets/TargetManagers.svg)

Let's create Executors by calling our hypothetical `executorForPlan` on each target's Plans.

![](../../_assets/Executors.svg)

We've created three Executors in total. `circleView` has two Executors. `squareView` has one. You might be wondering now: "Why is there only one gesture Executor for the squareView?"

A single Executor instance is created for each _type_ of Plan registered to a target. This allows Executors to maintain coherent state even when multiple Plans have been committed.

### Step 5: Provide Plans to Executors

The Scheduler now provides each Plan instance to the relevant Executor. This allows the Executor to translate specific Plans in to actionable logic.

### Step 6: Executors execute Plans

Executors can execute their Plans in countless ways. Let's focus on two of them.

**Manual execution**

Executors will be notified each time the system will draw a new frame by the Scheduler's `update` event. The Executor is expected to calculate and set its target's next state on each update event.

**Delegated execution**

An Executor could also delegate its work to a platform-native API, like Web Animations or  CoreAnimation. The Executor would be responsible for informing the Scheduler of two things: when delegated execution will start, and when delegated execution has ended.

<!--

LGTM:
- appsforartists

-->