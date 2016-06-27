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

**Read-only direction API**: Transition directors have a settable direction property.

`direction` is initialized with the initial direction of the transition when the director is created.

Example pseudo-code:

    enum TransitionDirection {
      .ToTheRight
      .ToTheLeft
    }
    
    TransitionDirector {
      var direction
    }

<p style="text-align:center"><tt>/MVP</tt></p>

---

**Directionality**: Transition Directors think in terms of "left" and "right + a direction.

**View duplication**: Transition Directors should have a view duplicator.
