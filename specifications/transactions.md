# Transactions

Transactions aggregate requests for Intention-target associations. Transactions are designed to be committed to a Runtime.

**Creation** `v1`: Transactions can be created at any time.

    transaction = Transaction()

**Operations**: Transactions should support the following operations.

> Note: the function names included below are not prescriptive. Provide argument names and context where your language allows. It is more important that you support the operation and the relevant arguments than what the exact API is called.

`v1` support:

    # Associate an Intention with a target.
    transaction.add(intention, target)

`feature: named` support:

    # Associate a named Intention with a target.
    transaction.add(intention, name, target)
    
    # Remove any named Intention from a target.
    transaction.remove(name, target)

**Enumerating operations** `v1`: Operations recorded to a transaction must be enumerable.

Operations must enumerate in the exact same order in which they were recorded.

**Copying Intentions** `v1`: When an Intention is added to a transaction it must be copied. This ensures that subsequent modifications to the Intention object do not "sneak" in to the transaction. For example:

    intention.fromValue = 0
    transaction.add(intention, target)
    
    intention.fromValue = 5
    transaction.add(intention, target)

The transaction's log must look like so:

    [add(intention (fromValue = 0), add(intention (fromValue = 5)]

Note that the first intention's `fromValue` did not magically transform into `5`.

**Committing** `v1`: Transactions must be committed to a Runtime.

    runtime.commit(transaction)

**Serialization** `feature: serialization`: Transactions may be serializable.

Serializable transactions can be sent over a wire or recorded to disk.
