Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# TransitionController specification

This is the engineering specification for the `TransitionController` object.

A

---

<p style="text-align:center"><tt>MVP</tt></p>

**Concrete type**: A `TransitionDirector` is a concrete type that conforms to the `Director` protocol.

Example pseudo-code:

    TransitionDirector: Director {
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
