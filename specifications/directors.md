Status of this document: **Drafting by featherless**

# Directors

A Director is an entity that describes an interactive experience. Directors make use of a Runtime.

**Transitions**. A Director is a natural fit for describing a Transition. Such a Director benefits from having a State Machine and Timeline primitive at hand.

**Logic**. Directors often involve a combination of conditional logic and Intentions.

## Set up phase

A Director should have some form of set up phase.

**Runtime**. Provide an instance of a Runtime to this phase. This allows many Directors to affect a single Runtime.

**Initial Intentions**. During the set up phase a Director may register an initial set of Intentions with a Runtime.

    function setUp(runtime) {
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

**State changes**. A typical state change is the reversal of a Transition midway through.

    function onTransitionEvent(transition) {
      transaction = Transaction()
      if transition.direction == ToTheRight {
        // Register incoming Intentions
      } else {
        // Register outgoing Intentions
      }
      runtime.commit(transaction)
    }
