Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# TransitionDirector

This is the engineering specification for the `TransitionDirector` object.

A instance of a `TransitionDirector` conforms to the `Director` protocol and provides essential scaffolding for managing a transition.

---

<p style="text-align:center"><tt>MVP</tt></p>

**Conrete type**: A `TransitionDuplicator` is a concrete type.

Example pseudo-code:

    protocol Duplicator {
    }

<p style="text-align:center"><tt>/MVP</tt></p>

---

**Directionality**: Transition Directors think in terms of "left" and "right + a direction.

**View duplication**: Transition Directors should have a view duplicator.
