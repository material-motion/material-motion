Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# Transactions

Transactions aggregate requests for Intention-target associations. Transactions can be committed to a Runtime.

**Operations**: Transactions should support the following operations:

    # Associate an Intention with a target.
    add(intention, target)
    
    # Associate a named Intention with a target.
    set(intention, name, target)
    
    # Remove any named Intention from a target.
    unset(name, target)

