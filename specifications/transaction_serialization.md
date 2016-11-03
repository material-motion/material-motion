---
layout: page
---

Status of this document:
![]({{ site.url }}/assets/under-construction-flashing-barracade-animation.gif)

# Transaction serialization

A serialized transaction contains plans and associated target selectors in a log.

Serializable transactions can be sent over a wire or recorded to disk.

**serialize/deserialize API**: Provide APIs for serializing and deserializing a transaction.

Example pseudo-code:

    # Serialize the transaction
    data = transaction.serialize()
    
    # Create a new transaction from data
    transaction = Transaction(data)

## Examples

Example pseudo-data:

```
[
  {
    operation: "add",
    plan: SerializedPlan,
    targetSelector: "#contextView"
  },
  {
    operation: "add",
    name: "someName",
    plan: SerializedPlan,
    targetSelector: "Photo"
  }
]
```
