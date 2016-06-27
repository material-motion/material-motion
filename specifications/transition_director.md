Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# TransitionDirector

Transition Directors are concerned with elegantly moving from one state to another.

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
