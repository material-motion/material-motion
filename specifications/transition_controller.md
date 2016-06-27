Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# TransitionController specification

This is the engineering specification for the `TransitionController` object.

`TransitionController` is the bridge between the platform's transitioning architecture and the `TransitionDirector` type.

---

<p style="text-align:center"><tt>MVP</tt></p>

**Concrete type**: A `TransitionController` is a concrete type.

Example pseudo-code:

    TransitionController {
    }

**Director API**: A `TransitionController` is a concrete type.

Example pseudo-code:

    TransitionController {
    }

<p style="text-align:center"><tt>MVP</tt></p>

---

TODO: Spec out.

The owner of a Transition Director is responsible for creating a Runtime and committing the Transaction.

Example pseudo-code:

    runtime = Runtime()
    transaction = Transaction()
    
    director = Director()
    director.setUp(transaction)
    
    runtime.commit(transaction)
