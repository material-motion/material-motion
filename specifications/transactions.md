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

**Copying Intentions**: When an Intention is added to a transaction it must be copied. This ensures that subsequent modifications to the Intention object do not "sneak" in to the transaction.

**Committing**: Transactions must be committed to a Runtime.

    runtime.commit(transaction)
