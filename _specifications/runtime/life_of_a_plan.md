---
layout: page
---

## Life of a plan

Let's walk through the life of a plan.

> Note: any code you see here is pseudo-code.

### Step 1: Create a runtime

Runtimes are cheap and easy to create. Many runtimes may exist in an application. Let's create one. We will make use of this object later.

```
runtime = Runtime()
```

![](/assets/LifeOfAPlan-step1.svg)

### Step 2: Create plans

All motion in a runtime begins with a plan. Let's create four different types of plan:

```
animation = Tween()
animation.property = "opacity"
animation.from = 0
animation.to = 1

draggable = Draggable()
pinchable = Pinchable()
rotatable = Rotatable()
```

![](/assets/LifeOfAPlan-step2.svg)

### Step 3: Add the plans to the runtime

Let's say we have two targets - a circle and a square - to which we want to associate our plans.

![](/assets/LifeOfAPlan-step3-targets.svg)

Plans are associated to targets:

```
runtime.addPlan(animation, to: circleView)
runtime.addPlan(draggable, to: squareView)
runtime.addPlan(pinchable, named: "name1", to: squareView)
runtime.addPlan(rotatable, named: "name2", to: squareView)
runtime.removePlan(named: "name2", from: squareView)
runtime.addPlan(draggable, to: circleView)
```

After executing the above code, the runtime's internal state might resemble this:

![](/assets/LifeOfAPlan-step4.svg)

> Note that `Rotatable` is not listed. This is because we also removed any plan named "name2".

The runtime uses entities called **performers** to execute its plans. A performer is a specialized mediating agent between a plan and its fulfillment.

We'll assume a function exists that returns a performer capable of executing a type of plan. The method signature for this method might look like this:

```
function performerForPlan(Plan, target, existingPerformers) -> Performer
```

The runtime creates performers by calling our hypothetical `performerForPlan` on each provided plan.

We've created three performers in total. `circleView` has two performers. `squareView` has one.

> Why is there only one gesture performer for the squareView?
> 
> A single performer instance is created for each _type_ of plan registered to a target. This allows performers to maintain coherent state even when multiple plans have been committed.

### Step 3a: Provide plans to performers

The runtime passes each plan instance to the relevant performer. This allows each performer to translate plans into actionable logic.

### Step 4: Performers execute plans

A performer is expected to fulfill the contract defined by its plan. Performers can fulfill their contract in two ways: continuously and via composition.

A continuous performer will

1. acquire a token indicating that continuous work will start,
2. initiate the continuous work, and then
3. release the token upon completion of the continuous work.

A performer that composes its execution will emit new plans. These new plans may create performers that emit new plans, and so on.
