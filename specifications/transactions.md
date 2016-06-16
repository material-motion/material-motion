Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# Transactions

Transactions aggregate requests for Intention-target associations. Transactions can be committed to a Runtime.

**Operations**: Transactions should support the following operations:

    addIntention(intention, toTarget: target)

Associates an intention with a target.

    setNamedIntention(intention, withName:name, toTarget: target)

Associates a named intention with a target.

    removeIntentionNamed(name, fromTarget: target)

Removes a named intention with a target.
