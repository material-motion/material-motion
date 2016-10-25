# ContextTransition

This is the engineering specification for the `ContextTransition` concrete type.

## Overview

A `ContextTransition` defines the essential information required by a `ContextTransitionDirector`.

## MVP

**Concrete type**: `ContextTransition` is an object.

Example pseudo-code:

```
class ContextTransition {
}
```

**Initial direction API**: Provide a read-only value of the transition's initial direction.

```
class TransitionContext {
  let initialDirection: TransitionWindowDirection
}
```

**Initialization API**: Define a required API that allows a director to receive a `TransitionContext`.

Example pseudo-code:

```
protocol TransitionDirector {
  init(TransitionContext)
}
```

**setUp API**: Define a required API that allows a director to set up its initial plans.

Example pseudo-code:

```
protocol TransitionDirector {
  function setUp()
}
```

**fore/back APIs**: Provide storage for information relevant to the transition.

Example pseudo-code:

```
MyTransitionDirector: TransitionDirector {
  public var foreViewController
  public var backViewController
  public var transitionDirection: TransitionDirection
}
```

**TransitionDirection type**: Provide a `TransitionDirection` type with two opposite values.

Example pseudo-code:

```
enum TransitionDirection {
  case forward
  case backward
}
```

**Initial transition direction API**: Transition directors have a read-only `initialTransitionDirection` API.

Provide the initial transition direction of the transition to the director's initializer.

Example pseudo-code:

```
TransitionDirector {
  readonly var initialTransitionDirection: TransitionDirection
  init(initialTransitionDirection)
}
```

**ReplicaController API**: Transition directors have a private read-only `replicaController` API.

Provide the replica controller to the director's initializer.

This API is not accessible to sub-classes.

Example pseudo-code:

```
TransitionDirector {
  private readonly var replicaController
  init(replicaController)
}
```

**ReplicaControllerDelegate API**: Transition directors can assign a `replicaControllerDelegate`.

Subclasses are expected to set a custom replica controller delegate using this API.

Example pseudo-code:

```
TransitionDirector {
  var replicaControllerDelegate
}
```

## Open Questions

* How might we avoid subclassing this type?
* Should we provide `TransitionDirector` with a timeline?
* How does the `TransitionDirector` change the direction of the transition?


