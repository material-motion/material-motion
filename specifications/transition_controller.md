Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# Transition Controller

TODO: Spec out.

The owner of a Transition Director is responsible for creating a Runtime and committing the Transaction.

Example pseudo-code:

    runtime = Runtime()
    transaction = Transaction()
    
    director = Director()
    director.setUp(transaction)
    
    runtime.commit(transaction)
