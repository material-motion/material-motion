# Transactions

Transactions aggregate requests for Intention-target associations. Transactions are designed to be committed to a Runtime.

`v1` **Creation**: Transactions can be created at any time.

    transaction = Transaction()

**Operations**: Transactions should support the following operations.

> Note: the function names included below are not prescriptive. Choose appropriate names for your language/platform conventions.

`v1` operations:

    # Associate an Intention with a target.
    transaction.add(intention, target)

`feature: named` operations:

    # Associate a named Intention with a target.
    transaction.add(intention, name, target)
    
    # Remove any named Intention from a target.
    transaction.remove(name, target)

`v1` **Enumerating operations**: Operations recorded to a transaction must be enumerable.

Operations must enumerate in the exact same order in which they were recorded.

`v1` **Copying Intentions**: When an Intention is added to a transaction it must be copied. This ensures that subsequent modifications to the Intention object do not "sneak" in to the transaction. For example:

    intention.fromValue = 0
    transaction.add(intention, target)
    
    intention.fromValue = 5
    transaction.add(intention, target)

The transaction's log must look like so:

    [add(intention (fromValue = 0), add(intention (fromValue = 5)]

Note that the first intention's `fromValue` did not magically transform into `5`.

`v1` **Committing**: Transactions must be committed to a Runtime.

    runtime.commit(transaction)

`feature: serialization` **Serialization**: Transactions may be serializable.

Serializable transactions can be sent over a wire or recorded to disk.

`feature: optimized` **Optimizations**: Transactions can optimize their operations.

TODO: Emphasize that it's important that which targets were "touched" by a Transaction is not lost. The Runtime needs this for its "new target" event.
