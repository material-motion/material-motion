Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# Plan serialization specification

Plans must be serializable to a data format containing the following information:

* motionFamily: `String`
* name: `String`
* properties: `Dictionary`

**Identifying the plan**: A combination of `namespace` and `name` allows the runtime to uniquely identify a plan in a given system.

**serialize/deserialize API**: Provide APIs for serializing and deserializing a plan.

Example pseudo-code:

    # Serialize the plan
    data = plan.serialize()
    
    # Create a new plan from data
    plan = Plan(data)

A serialized plan is represented as a stream of bytes. These bytes can represent any format.

**Payload contents**: Plans can choose any format for their payload.

Plans must consider how they will handle future changes to their payload format.

## Examples

The following example serializes a specific Tween plan:

```
let fadeIn = Tween(keyPath: "opacity")
fadeIn.from = 0
fadeIn.to = 1
fadeIn.curve = .easeIn

data = Serializer.toBinary(fadeIn)
{
  namespace: "Tween",
  name: "Tween",
  payload: {
    keyPath: "opacity"
    from: 0,
    to: 1
    curve: "easeIn"
  }
}
```

The following example serializes a more abstract FadeIn compositional plan:

```
let fadeIn = FadeIn()

data = Serializer.toBinary(fadeIn)
{
  namespace: "Tween",
  name: "FadeIn",
  payload: {}
}
```
