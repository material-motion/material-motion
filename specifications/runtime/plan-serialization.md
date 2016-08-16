# Plan serialization specification

Plans are serializable.

Serializable plans can be sent over a wire or recorded to disk.

**serialize/deserialize API**: Provide APIs for serializing and deserializing a plan.

Example pseudo-code:

    # Serialize the plan
    json = plan.serialize()
    
    # Create a new plan from json
    plan = Plan(json)

A serialized plan is represented as a stream of bytes. These bytes can represent any format.

Further reading: [Serialization](../serialization.md)
