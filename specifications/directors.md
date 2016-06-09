Status of this document: **Drafting by featherless**

# Directors

A Director is an entity that describes an interactive experience. Directors make use of a Runtime.

**Transitions**. A Director is a natural fit for describing a Transition. Such a Director benefits from having a State Machine and Timeline primitive at hand.

**Logic**. Directors often involve a combination of conditional logic and Intentions.

## Set up phase

A Director should have some form of set up phase. Provide an instance of a Runtime to this phase. This allows many Directors to affect a single Runtime.

During the set up phase a Director may register an initial set of Intentions with a Runtime.

    function setUp(runtime) {
      transaction = Transaction()
      
      runtime.commit(transaction)
    }

**Gestures**. This is also a good opportunity for the Director to register any new gesture recognizers. The Director will want to store the Runtime so that it can make further Transactions at a later point.

    function onGesture(gesture) {
      if gesture.state == Ended {
        transaction = Transaction()
        // Some new Intentions
        runtime.commit(transaction)
      }
    }
