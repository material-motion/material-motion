Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# Transactions

Transactions aggregate requests for Intention-target associations. Transactions can be committed to a Runtime.

**Operations**: Transactions should support the following operations:

    # Associate an intention with a target.
    addIntention(intention, toTarget: target)
    
    # Associate a named intention with a target.
    setIntention(intention, named:name, toTarget: target)
    
    # Remove a named intention with a target.
    unsetIntentionNamed(name, fromTarget: target)

