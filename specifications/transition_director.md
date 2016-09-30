# TransitionDirector specification

This is the engineering specification for the `TransitionDirector` object.

## Overview

A `TransitionDirector` provides essential scaffolding for managing a transition. A `TransitionDirector` class is instantiated by a `TransitionController`.

`TransitionDirector` conforms to the `Director` protocol.

Printable tech tree/checklist:

![](../_assets/TransitionDirectorTechTree.svg)

## MVP

**Concrete type**: A `TransitionDirector` is a concrete type that adheres to the informal Director APIs.

Example pseudo-code:

    TransitionDirector {
      function setUp()
    }

**Subclassing**: This class is designed to be subclassed.

The sub-class is expected to implement the functions specified in the `Director` protocol.

Example pseudo-code:

    MyTransitionDirector: TransitionDirector {
      function setUp() {
        // Perform set up operations
      }
    }

**from/to APIs**: Provide storage for information relevant to the transition.

Example pseudo-code:

    MyTransitionDirector: TransitionDirector {
      public var fromViewController
      public var toViewController
      public var transitionDirection
    }

**Transition direction type**: Provide a `TransitionDirection` type with two opposite values.

Many synonyms exist. Use that which applies best to your platform.

- present/dismiss
- push/pop
- forward/back

Example pseudo-code:

    enum TransitionDirection {
      .Present
      .Dismiss
    }

**Initial transition direction API**: Transition directors have a read-only `initialTransitionDirection` API.

Provide the initial transition direction of the transition to the director's initializer.

Example pseudo-code:

    enum TransitionDirection {
      .Present
      .Dismiss
    }
    
    TransitionDirector {
      readonly var initialTransitionDirection
      init(initialTransitionDirection)
    }

**ReplicaController API**: Transition directors have a private read-only `replicaController` API.

Provide the replica controller to the director's initializer.

This API is not accessible to sub-classes.

Example pseudo-code:

    TransitionDirector {
      private readonly var replicaController
      init(replicaController)
    }

**ReplicaControllerDelegate API**: Transition directors can assign a `replicaControllerDelegate`.

Subclasses are expected to set a custom replica controller delegate using this API.

Example pseudo-code:

    TransitionDirector {
      var replicaControllerDelegate
    }

---

<p style="text-align:center"><tt>feature: Transition preconditions</tt></p>

A transition can register certain pre-conditions. If any pre-condition fails, the director will not be selected for use in the transition.

**Preconditions API**: Provide an API for registering new preconditions.

Example pseudo-code:

    TransitionDirector {
      function registerPrecondition(function)
      
      init() {
        registerPrecondition(function() {
          // Verify that some element exists
          return elementExists
        })
      }
    }

<p style="text-align:center"><tt>/feature: Transition preconditions</tt></p>

---

## Open Questions ##

- How might we avoid subclassing this type?
- Should we provide `TransitionDirector` with a timeline?
- How does the `TransitionDirector` change the direction of the transition?
