Status of this document: **Drafting by featherless**

# Directors

A Director is an entity that describes an interactive experience. Directors make use of a Runtime.

**Transitions**. Directors are great entities to describe Transitions. Such Directors benefit from having a State Machine and Timeline primitive at hand.

**Logic**. Directors often involve a combination of conditional logic and Intentions.

## Set up phase

A Director should have some form of set up phase. Provide an instance of a Runtime to this phase. This allows many Directors to affect a single Runtime.

During the set up phase a Director may register an initial set of Intentions with a Runtime.

    function setUp(runtime) {
      transaction = Transaction()
      
      runtime.commit(transaction)
    }