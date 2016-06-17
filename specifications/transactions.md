# Transactions

Transactions aggregate requests for Intention-target associations. Transactions can be committed to a Runtime.

**Creation**: Transactions can be created at any time.

    transaction = Transaction()

**Operations**: Transactions should support the following operations.

Minimal support:

    # Associate an Intention with a target.
    transaction.add(intention, target)

Named Intentions support:

    # Associate a named Intention with a target.
    transaction.set(intention, name, target)
    
    # Remove any named Intention from a target.
    transaction.unset(name, target)

**Committing**: Transactions must be committed to a Runtime.

    runtime.commit(transaction)
