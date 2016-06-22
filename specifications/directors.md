Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# Director

This is the engineering specification for the Director abstract type.

A Director is an object created for the purposes of describing motion.

Directors have little — if any — imperative code. Directors prefer to describe motion in terms of declarative Plans.

---

<p style="text-align:center"><tt>MVP</tt></p>

**Set up API**: A Director implements a `setUp` function. This function will be invoked exactly once. This function accepts a Transaction instance.

Example pseudo-code:

    MyDirector {
      function setUp(transaction) {
        // Set things up
      }
    }

**Initial Plans**. Directors are expected to commit Plans to `setUp`'s provided transaction .

Pseudo-code:

    function setUp(transaction) {
      transaction.add(plan, targetA)
      transaction.add(plan, targetB)
      ...
    }

**No Runtime access**: Directors do not have direct access to a Runtime.

The primary goal of this restriction is to minimize the number of novel APIs the Director must interact with. A Transaction is the preferred bridge between a Director and a Runtime.

We may lift this restriction if there are strong technical reasons to do so.

<p style="text-align:center"><tt>/MVP</tt></p>

---

<p style="text-align:center"><tt>feature: tear-down</tt></p>

Directors may implement a `tearDown` function. This function must be invoked when the associated Runtime is about to terminate.

**Tear down API**: The `tearDown` function, if implemented, is invoked when the Director's corresponding Runtime is about to terminate.

Pseudo-code example:

    MyDirector {
      function tearDown() {
        // Perform any cleanup work
      }
    }

<p style="text-align:center"><tt>/feature: tear-down</tt></p>

---

<p style="text-align:center"><tt>feature: post-setup transactions</tt></p>

Directors may wish to register new Plans after `setUp` has been invoked.

**Transact API**: A Director may be provided with a *transaction initiation function*.

Consider the following pseudo-code:

    MyDirector {
      var transact // settable
    }

Provide the Director with a function that resembles the following:

    var transact = function(work) {
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

-->
