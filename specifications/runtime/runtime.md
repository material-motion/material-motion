# Runtime specification

This is the engineering specification for the `Runtime` object.

| Discussion thread | Moderator | Status |
|:------------------|:-------|:-------|
| [Rename Scheduler to [Runtime]?](https://groups.google.com/forum/#!topic/material-motion/FNULoSyqEOo) | appsforartists | Accepted on Nov 1, 2016 |

|     | Android | Apple | Web |
|:----|:--------|:------|:----|
| Available since | [Runtime 1.0.0](https://github.com/material-motion/material-motion-runtime-android/releases) | [Runtime 1.0.0](https://github.com/material-motion/material-motion-runtime-objc/releases/tag/v1.0.0) | &nbsp; |

## Features

- [Named plans](named-plans.md)
- [Target selectors](target-selectors.md)

## Overview

A runtime receives plans and creates performers. The runtime generates relevant events for performers and monitors activity.

## MVP

### Simple initializer

A runtime is cheap to create.

Example pseudo-code:

    runtime = Runtime()

### addPlan API

#### Provide an API for adding an association of a plan with a target.

This API must accept a plan and a target object.

Example pseudo-code:

    # Associate a plan with a target.
    runtime.addPlan(plan, to: target)

#### One instance of a performer type per target

Create one performer instance for each *type* of performer required by a target. This allows multiple plans to affect a single performer instance. The performers can then maintain state across multiple plans.

![](../../_assets/OnePerformer.svg)

> Consider the following pseudo-code involving physical simulation:
> 
>     runtime.addPlan(Friction(), to: circleView)
>     runtime.addPlan(AnchoredSpringAtLocation(x, y), to: circleView)
> 
> `circleView` now has two plans and one performer, a `PhysicalSimulationPerformer`. Both plans have been provided to the performer instance.
> 
> The performer knows the following:
> 
> - It has two forces, both affecting `position`.
> - It needs to model `velocity` for the `position`.
> 
> The performer creates some state that will track the position's velocity.
> 
> The performer can now:
> 
> 1. convert each plan into a physics force,
> 2. apply the force to the velocity, and
> 3. apply the velocity to the position
>
> on every update event.
> 
> Alternatively, consider how this situation would have played out if we had one performer for each plan. There would now be two conflicting representations of `velocity` for the same `position`. On each frame, one performer would "lose". The result would be a confusing animation.

Note that "one performer per type of plan" does not resolve the problem of sharing state across different types of plans. This is an open problem.

#### Plan ↔ performer association

The runtime must be able to translate plans into performers.

Plans define their performer type explicitly.

Example pseudo-code:
  
    class SomePlan {
      function performerType() {
        return SomePerformer.type
      }
    }
    
    # In the runtime...
    performerType = plan.performerType()
    performer = performerType()

#### Unit Tests

- [JavaScript](https://github.com/material-motion/material-motion-experiments-js/blob/develop/packages/runtime/src/__tests__/Runtime-addPlan.test.ts)

### Activity state

Activity state is one of either active or at rest. The runtime must provide a public read-only API for accessing this state.

Pseudo-code example:

    public enum ActivityState {
      .Active
      .AtRest
    }
    
    Runtime {
      public function activityState() -> ActivityState
    }

A runtime is active if any of its performer instances are active.

---

## Open topics

The following topics are open for discussion. They do not presently have a clear recommendation.

- When should performers be removed from a runtime?
- Should runtimes support target-less plans?

---

## Proposed features

### Dynamic Plan ↔ Performer map

#### Map performer type to plan type with look-up table.

Performers define which plans they can fulfill. This approach allows plans to be less intelligent. But it introduces the possibility of performers conflicting on a given plan. The runtime would need to be able to determine which one to use.

Example pseudo-code:
  
    # In some initialization step...
    runtime.performerType(SomePerformer.type, canExecutePlanType: SomePlan.type)
    
    # In the runtime...
    performerType = plan.performerTypeForPlan(plan)
    performer = performerType()


### Tear down API

####Provide an API to tear down a runtime.

This API would terminate all active performers and remove all registered plans.

It's unclear if this is a necessary feature.

Example pseudo-code:

    runtime.tearDown()

### Garbage-collecting performers

To prevent a monotonically-increasing heap of performers from introducing a potential memory leak, a runtime may desire some strategy for removing references to old performers.

The [JavaScript implementation](https://github.com/material-motion/material-motion-experiments-js/) is considering removing references after the runtime has be at rest for at least 500ms.  This was chosen for a few reasons:

- According to the [RAIL](https://developers.google.com/web/tools/chrome-devtools/profile/evaluate-performance/rail?hl=en) pattern, users are unlikely to notice a slow first frame in an animation.  This makes the first frame a good time to instantiate new objects.

- The delay ensures that plans can be committed to the runtime one-frame-at-a-time without triggering garbage collection.

- 500ms is long enough that new plans in this sequence are unlikely, but short enough that the user is unlikely to be initiating new plans.

> Under this strategy, it is especially important that performers can read the state that another performer may have set on a target.  Otherwise, when a performer is garbage collected and a new one takes its place, the new performer might reset the starting position of a target.  This would be jarring.

