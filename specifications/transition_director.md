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

<p style="text-align:center"><tt>/MVP</tt></p>

---

**Directionality**: Transition Directors think in terms of "left" and "right + a direction.

**View duplication**: Transition Directors should have a view duplicator.
