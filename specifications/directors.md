# MotionDirector specification

This is the engineering specification for the `MotionDirector` abstract type, or director for short.

A director is an object created for the purposes of describing motion.

Directors have little — if any — imperative code. Directors prefer to describe motion in terms of declarative plans.

Printable tech tree/checklist:

![](../_assets/MotionDirectorTechTree.svg)

---

<p style="text-align:center"><tt>MVP</tt></p>

**Set up API**: A director implements a `setUp` function. This function will be invoked exactly once. This function accepts a transaction instance.

Example pseudo-code protocol definition:

    protocol MotionDirector {
      function setUp(transaction)
    }

Directors are expected to commit plans to `setUp`'s provided transaction .

Example pseudo-code implementation:

    function setUp(transaction) {
      transaction.add(plan, targetA)
      transaction.add(plan, targetB)
      ...
    }

**No access to the scheduler**: Directors do not have direct access to a scheduler.

The primary goal of this restriction is to minimize the number of novel APIs a director must interact with. A transaction is the preferred bridge between a director and a scheduler.

<p style="text-align:center"><tt>/MVP</tt></p>

---

<p style="text-align:center"><tt>feature: tear-down</tt></p>

Directors may implement a `tearDown` function. This function is invoked when the associated scheduler is about to terminate.

**Tear down API**: The `tearDown` function, if implemented, is invoked when the director's corresponding scheduler is about to terminate.

Pseudo-code example:

    protocol TearDownDirecting {
      function tearDown() {
        // Perform any cleanup work
      }
    }

<p style="text-align:center"><tt>/feature: tear-down</tt></p>

---

<p style="text-align:center"><tt>feature: post-setup transactions</tt></p>

Directors may wish to register new plans after `setUp` has been invoked.

**Transact API**: A director may be provided with a *transaction initiation function*.

Example pseudo-code protocol:

    protocol TransactionDirecting {
      var transact // settable
    }

The provided function implementation might resemble the following:

    var transact = function(work) {
      transaction = Transaction()
      work(transaction)
      scheduler.commit(transaction)
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

TODO: Describe entity that manages creation of Director. This entity is responsible for creating a Director when appropriate, calling the setUp and tearDown methods, and owning the Scheduler instance.

<!--

LGTM:

-->
