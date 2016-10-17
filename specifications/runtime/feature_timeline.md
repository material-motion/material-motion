# Feature: timeline

This is the engineering specification for the **Timeline** type.

|  | Android | Apple | Web |
| --- | --- | --- | --- |
| MVP milestones | &nbsp; | &nbsp; | &nbsp; |

## Overview

This feature enables the description of motion along a *normalized* segment of time.

## Specification

**Direction type**: Timelines can move in one of two directions: forward or backward.

Define a direction type that includes both possible directions.

```
TimelineDirection {
  .forward:
  .backward:
}
```

**Object type**: A timeline is an object.

```
class Timeline {
}
```

**Initial direction API**: A timeline is aware of its initial direction.

```
class Timeline {
  TimelineDirection initialDirection
}
```

**Current direction API**: A timeline is aware of its current direction.

This should be initialized with the value of `initialDirection`.

```
class Timeline {
  TimelineDirection currentDirection
}
```

# Scheduler specification

Schedulers support named plans. Named plans are plans with a name associated via the transaction.

**Named APIs**: Provide an `addPlan` and `removePlan` API with a name argument.

Note that the plan type must be a `NamedPlan`. Motion family designers use this type to indicate which plans support being named.

Example pseudo-code:

```
class Scheduler {
  function addPlan(NamedPlan, named: String, to: Target)
  function removePlan(named: String, from: Target)
}

# Associate a named plan with a target.
scheduler.addPlan(plan, named: name, to: target)

# Remove any named plan from a target.
scheduler.removePlan(named: name, from: target)
```

**Target-scoped names**: Names are scoped to a target.

The scheduler maintains a separate named plan mapping for each target.

**Remove-then-add**: Two things happen when a named plan is added:

1. Remove any previously committed plan with the same name from the target's performers.

  _Note:_ This may be on a different performer instance on the same target. In the example above perhaps a PhysicsPerformer is needed for the second transaction, but not for the first.

2. Provide the relevant performer with the new named plan.

Example pseudo-code:

```
# Step 1
performerForName(name).removePlan(named: name)

# Step 2
performer = performerForPlan(plan)
performer.add(plan: plan, withName: name)
performerForName(name) == performer 
> true
```

