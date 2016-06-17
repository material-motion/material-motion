Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# Directors

A Director is an entity that describes an interactive experience. Directors make use of a Motion Runtime.

**Transitions**. A Director is a natural fit for describing a Transition. Such a Director benefits from having a State Machine and Timeline primitive at hand.

**Logic**. Directors often involve a combination of conditional logic and Intentions.

TODO: Create a flow chart showing the states a Director goes through. E.g. setUp, tearDown at a minimum.

TODO: Describe entity that manages creation of Director. This entity is responsible for creating a Director when appropriate, calling the setUp and tearDown methods, and owning the Runtime instance.

## Set up phase

A Director should have a `setUp` method that is invoked exactly once.

`v1` **Provide a Transaction**: The setUp method should receive a Transaction instance.

After `setUp` completes, the Transaction should be committed to a Runtime.

Hiding the Runtime from the Transaction has the following benefits:

- Director is funneled toward using a single Runtime instance.
- Larger Transactions can potentially be optimized.

`v1` **Initial Intentions**. The Director is expected to register an initial set of Intentions.

Pseudo-code:

    function setUp(Runtime) {
      transaction = Transaction()
      
      runtime.commit(transaction)
    }

## Event handling

The Director may want to store a reference to the Runtime in order to commit new Intentions in response to different events.

**Gestures**. The Director will want to store the Runtime so that it can make further Transactions at a later point.

    function onGesture(gesture) {
      if gesture.state == Ended {
        transaction = Transaction()
        // Some new Intentions
        runtime.commit(transaction)
      }
    }

**State changes**. A Director may be the hub of many different types of state changes.

One type of state change is the reversal of a Transition's direction.

    function onStateChange(transition) {
      transaction = Transaction()
      if transition.direction == ToTheRight {
        // Register incoming Intentions
      } else {
        // Register outgoing Intentions
      }
      runtime.commit(transaction)
    }

## Specialized Directors

A Director class hierarchy might include specialized Director implementations that provide essential scaffolding.

### Transition Director

**Initialization**. A Transition Director is created when a Transition is about to occur. The Director's `setUp` method should be invoked at this point.

**End state**. The Director is responsible for communicating when the Transition has ended. The Director will likely make use of the Motion Runtime's idle/active events to communicate this.

<!--

LGTM:
- featherless

-->
