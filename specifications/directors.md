Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# Directors

A Director is an object that describes an interactive experience.

A Director operates primarily in terms of targets and Plans. Directors must not have direct access to a Runtime.

> Hiding the Runtime from the Director has the following benefits:
> 
> - There is a primary Runtime.
> - Big Transactions can potentially be optimized.

---

<p style="text-align:center"><tt>MVP</tt></p>

**Set up**: A Director has a `setUp` method that is invoked exactly once.

The setUp method should receive a Transaction instance.

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

**Initial Plans**. The Director is expected to register an initial set of Plans.

Pseudo-code:

    function setUp(Runtime) {
      transaction.add(plan, targetA)
      transaction.add(plan, targetB)
      ...
    }

`v1` **Providing targets**: Directors must be provided with target objects.

How a Director receives targets is up to the engineer. Common solutions include:

- *Delegate pattern*. The Director requests targets via a delegate.
- *Initialization*. Targets are provided to the Director's initializer.

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

A classic example is a Director that is responding to gesture recognition events. Consider the following pseudo-code:

    function onGesture(gesture) {
      if gesture.state == Ended {
        self.transact(function(transaction) {
          transaction.add(plan, targetA)
        }
      }
    }

One type of state change is the reversal of a Transition's direction.

    function onStateChange(transition) {
      transaction = Transaction()
      if transition.direction == ToTheRight {
        // Register incoming Plans
      } else {
        // Register outgoing Plans
      }
      runtime.commit(transaction)
    }

## Specialized Directors

Specialized Directors should be provided for common operations.

- [Transition Directors](transition_directors.md)
- [Interaction Directors](interaction_directors.md)

TODO: Create a flow chart showing the states a Director goes through. E.g. setUp, tearDown at a minimum.

TODO: Describe entity that manages creation of Director. This entity is responsible for creating a Director when appropriate, calling the setUp and tearDown methods, and owning the Runtime instance.

<!--

LGTM:
- featherless

-->
