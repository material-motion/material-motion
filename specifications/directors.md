Status of this document: **Drafting by featherless**

# Directors

A Director is an entity that describes an interactive experience. Directors make use of a Motion Runtime.

**Transitions**. A Director is a natural fit for describing a Transition. Such a Director benefits from having a State Machine and Timeline primitive at hand.

**Logic**. Directors often involve a combination of conditional logic and Intentions.

## Set up phase

A Director should have some form of set up phase.

**Motion Runtime**. Provide an instance of a Motion Runtime to this phase. This allows many Directors to affect a single Motion Runtime.

**Initial Intentions**. During the set up phase a Director may register an initial set of Intentions with a Motion Runtime.

    function setUp(Motion Runtime) {
      transaction = Transaction()
      
      runtime.commit(transaction)
    }

## Event handling

The Director may want to store a reference to the Motion Runtime in order to commit new Intentions in response to different events.

**Gestures**. The Director will want to store the Motion Runtime so that it can make further Transactions at a later point.

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
