## Life of a plan

Let's walk through the life of a plan.

>Remember, any code you see here is pseudo-code.

### Step 1: Create a scheduler

Schedulers are cheap and easy to create. Many schedulers may exist in an application. Let's create one.

    scheduler = Scheduler()

![](../../_assets/LifeOfAPlan-step1.svg)

### Step 2: Create plans

All motion in a runtime begins with a plan. Let's create four different types of plan:

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

First we must create a transaction.

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

A transaction must be committed to a scheduler in order for it to take affect.

    scheduler.commit(transaction)

After committing the above transaction, the scheduler's internal state might resemble this:

![](../../_assets/TargetManagers.svg)

> Note that `Rotatable` is not listed. This is because we also removed any plan named "name2" in this transaction.

The scheduler is now expected to perform the committed plans.

### Step 4: Scheduler creates performers

The scheduler uses entities called **performers** to execute its plans. An performer is a specialized mediating agent between a plan and its execution.

We'll assume a function exists that returns an performer capable of executing a type of plan. The method signature for this method might look like this:

    function performerForPlan(Plan, target, existingPerformers) -> Performer

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

When we commit this transaction to the scheduler, our scheduler has the following representation of the committed plans:

![](../../_assets/TargetManagers.svg)

The scheduler now creates performers by calling our hypothetical `performerForPlan` on each target's plans.

![](../../_assets/Performers.svg)

We've created three performers in total. `circleView` has two performers. `squareView` has one. You might be wondering now: "Why is there only one gesture performer for the squareView?"

A single performer instance is created for each _type_ of plan registered to a target. This allows performers to maintain coherent state even when multiple plans have been committed.

### Step 5: Provide plans to performers

The scheduler now provides each plan instance to the relevant performer. This allows the performer to translate specific plans in to actionable logic.

### Step 6: Performers execute plans

Performers can execute their plans in countless ways. Let's focus on two of them.

**Manual execution**

Performers will be notified each time the system will draw a new frame by the scheduler's `update` event. The performer is expected to calculate and set its target's next state on each update event.

**Delegated execution**

An performer could also delegate its work to a platform-native API, like Web Animations or  CoreAnimation. The performer would be responsible for informing the scheduler of two things: when delegated execution will start, and when delegated execution has ended.

<!--

LGTM:
- appsforartists

-->