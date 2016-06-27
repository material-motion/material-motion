# TransitionDirector specification

This is the engineering specification for the `TransitionDirector` object.

A `TransitionDirector` provides essential scaffolding for managing a transition. A `TransitionDirector` class is instantiated by a `TransitionController`.

`TransitionDirector` conforms to the `Director` protocol.


Printable tech tree/checklist:

![](../_assets/TransitionDirectorTechTree.svg)

---

<p style="text-align:center"><tt>MVP</tt></p>

**Concrete type**: A `TransitionDirector` is a concrete type that conforms to the `Director` protocol.

Example pseudo-code:

    TransitionDirector: Director {
    }

**Subclassing**: This class is designed to be subclassed.

The sub-class is expected to implement the functions specified in the `Director` protocol.

Example pseudo-code:

    MyTransitionDirector: TransitionDirector {
      function setUp() {
        // Perform set up operations
      }
    }

**Left/right side APIs**: Provide storage for relevant information to the transition.

Transition directors think in terms of left and right *sides* of the transition. Provide APIs for storing relevant information.

Example pseudo-code:

    MyTransitionDirector: TransitionDirector {
      public var leftViewController
      public var rightViewController
    }

**Transition direction type**: Provide a `TransitionDirection` type with two possible values: *to the left* and *to the right*.

Example pseudo-code:

    enum TransitionDirection {
      .ToTheRight
      .ToTheLeft
    }

**Initial direction API**: Transition directors have a read-only `initialDirection` API.

Provide the initial direction of the transition to the director's initializer.

Example pseudo-code:

    enum TransitionDirection {
      .ToTheRight
      .ToTheLeft
    }
    
    TransitionDirector {
      readonly var initialDirection
      init(initialDirection)
    }

**Duplicator API**: Transition directors have a read-only `duplicationController` API.

Provide the duplication controller to the director's initializer.

Example pseudo-code:

    TransitionDirector {
      readonly var duplicationController
      init(duplicationController)
    }

<p style="text-align:center"><tt>/MVP</tt></p>

---

<p style="text-align:center"><tt>feature: Context element</tt></p>

The context element is what that the user interacted with in order to initiate the transition.

**Context element API**: Provide an API for retrieving the transition's context element.

Example pseudo-code:

    TransitionDirector {
      readonly var contextElement
    }

<p style="text-align:center"><tt>/feature: Context</tt></p>

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
