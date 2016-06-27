Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# TransitionDirector

This is the engineering specification for the `TransitionDirector` object.

A instance of a `TransitionDirector` conforms to the `Director` protocol. A `TransitionDirector` provides essential scaffolding for managing a transition. A `TransitionDirector` class is instantiated by a `TransitionController`.

---

<p style="text-align:center"><tt>MVP</tt></p>

**Conrete type**: A `TransitionDirector` is a concrete type that conforms to the `Director` protocol.

Example pseudo-code:

    TransitionDirector: Director {
    }

**Left/right side**: Transition directors think in terms of left and right *sides* of the transition.

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

<p style="text-align:center"><tt>/MVP</tt></p>

---

**View duplication**: Transition Directors should have a view duplicator.
