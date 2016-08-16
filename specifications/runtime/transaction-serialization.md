# Transaction serialization specification

Transactions are serializable.

Serializable transactions can be sent over a wire or recorded to disk.

**serialize/deserialize API**: Provide APIs for serializing and deserializing a transaction.

Example pseudo-code:

    # Serialize the transaction
    data = transaction.serialize()
    
    # Create a new transaction from data
    transaction = Transaction(data)

Open questions:

- How do we know which target to associate a given plan with?

Further reading: [Serialization](../serialization.md)
