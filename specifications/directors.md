Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# Directors

A Director is an object that describes an interactive experience.

A Director operates primarily in terms of targets and Plans. Directors must not have direct access to a Runtime.

> Hiding the Runtime from the Director has the following benefits:
> 
> - There is a primary Runtime.
> - Large Transactions can potentially be optimized.

`v1` **Set up**: A Director has a `setUp` method that is invoked exactly once.

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

`v1` **Initial Plans**. The Director is expected to register an initial set of Plans.

Pseudo-code:

    function setUp(Runtime) {
      transaction = Transaction()
      
      runtime.commit(transaction)
    }

## Event handling

The Director may want to store a reference to the Runtime in order to commit new Plans in response to different events.

**Gestures**. The Director will want to store the Runtime so that it can make further Transactions at a later point.

    function onGesture(gesture) {
      if gesture.state == Ended {
        transaction = Transaction()
        // Some new Plans
        runtime.commit(transaction)
      }
    }

**State changes**. A Director may be the hub of many different types of state changes.

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
