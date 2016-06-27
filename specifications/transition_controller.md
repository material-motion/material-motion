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

**One controller per transition**: Every transition has access to its own `TransitionController` instance.

**Transition director type API**: Provide a public API for storing a `TransitionDirector` type.

The type must be a subclass of `TransitionDirector`.

Example pseudo-code:

    TransitionController {
      public var directorType: type(TransitionDirector)
    }

**Runtime**: Store a single `Runtime` instance while the transition is active.

Create a Runtime when a transition is initiated.

Example pseudo-code:

    TransitionController {
      private var runtime: Runtime
    }

**System bridge**: Implement the necessary bridge for the platform's transitioning APIs.

This differs greatly from platform to platform.

<p style="text-align:center"><tt>/MVP</tt></p>

---

<p style="text-align:center"><tt>feature: director stack</tt></p>

TODO: Discuss director stack.

<p style="text-align:center"><tt>/feature: director stack</tt></p>

---

TODO: Spec out.

The owner of a Transition Director is responsible for creating a Runtime and committing the Transaction.

Example pseudo-code:

    runtime = Runtime()
    transaction = Transaction()
    
    director = Director()
    director.setUp(transaction)
    
    runtime.commit(transaction)
