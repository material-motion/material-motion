# Directors

A Director is an object that describes an interactive experience.

A Director operates primarily in terms of targets and Plans. Directors do not have direct access to a Runtime.

> Hiding the Runtime from a Director has the following benefits:
> 
> - There is a primary Runtime.
> - Big Transactions can potentially be optimized.

---

<p style="text-align:center"><tt>MVP</tt></p>

**Set up**: A Director has a `setUp` method that is invoked exactly once. This method must be provided with a Transaction instance.

Example pseudo-code:

    Director {
      function setUp(Transaction)
    }

The owner of a Director is responsible for creating a Runtime and committing the Transaction.

Example pseudo-code:

    runtime = Runtime()
    transaction = Transaction()
    
    director = Director()
    director.setUp(transaction)
    
    runtime.commit(transaction)

**First**: The `setUp` event must be the first event invoked on a Director.

**Initial Plans**. The Director registers Plans in `setUp`.

Pseudo-code:

    function setUp(Runtime) {
      transaction.add(plan, targetA)
      transaction.add(plan, targetB)
      ...
    }

`v1` **Providing targets**: Provide targets to Directors.

How targets are provided to a Director is up to the creator of the Director.

Common solutions include:

*Delegate pattern*. The Director requests targets via a delegate.

*Initialization*. Targets are provided to the Director's initializer.

![](../_assets/DirectorTransaction.svg)


<p style="text-align:center"><tt>/MVP</tt></p>

---

<p style="text-align:center"><tt>feature: tear-down</tt></p>

Directors may wish to receive a tearDown event when their Runtime is about to shut down.

<p style="text-align:center"><tt>/feature: tear-down</tt></p>

---

<p style="text-align:center"><tt>feature: post-setup transactions</tt></p>

Directors may wish to register new Plans after `setUp` has been invoked.

Provide these Directors a *transaction initiation function*. Consider the following pseudo-code:

    # Typical set up
    director.setUp(transaction)
    
    director.transact = function(function(Transaction) work) {
      transaction = Transaction()
      work(transaction)
      runtime.commit(transaction)
    }

The Director can now start a new transaction by invoking `transact`.

Consider the following pseudo-code of a Director responding to a gesture recognition event:

    function onGesture(gesture) {
      if gesture.state == Ended {
        self.transact(function(transaction) {
          transaction.add(plan, targetA)
        })
      }
    }

<p style="text-align:center"><tt>/feature: post-setup transactions</tt></p>

---

## Specialized Directors

Specialized Directors should be provided for common operations.

- [Transition Directors](transition_directors.md)
- [Interaction Directors](interaction_directors.md)

TODO: Describe entity that manages creation of Director. This entity is responsible for creating a Director when appropriate, calling the setUp and tearDown methods, and owning the Runtime instance.

<!--

LGTM:
- featherless

-->
