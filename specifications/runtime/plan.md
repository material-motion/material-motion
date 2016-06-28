# Plan specification

This is the engineering specification for the `Plan` abstract type.

A plan is an object representing **what you want something to do**.  As its name suggests, a `Plan` is an implementation of the [plan/performance pattern](../pattern.md).

Example plan objects:

- `SquashAndStretch` describes a target squashing and stretching in the direction of its movement.
- `Tween` describes a tween animation.
- `Draggable` describes gestural translation.
- `AnchoredSpring` describes a physical simulation.

Printable tech tree/checklist:

![](../../_assets/PlanTechTree.svg)

---

<p style="text-align:center"><tt>MVP</tt></p>

**Abstract type**: `Plan` is a protocol, if your language has that concept.

Pseudo-code example:

    protocol Plan {
    }

**Defines Executor type**: Plans define the type of executor that can fulfill them.

Pseudo-code example:

    protocol Plan {
      Class executorClass
    }

**Copyable**: Plans can be copied.

Modifications made to the copy do not affect the original.

This can be implemented in a variety of ways. We've included a few options we know of below:

- Immutable types.
- Value types.
- Implement a copy or clone method on a reference type.

<p style="text-align:center"><tt>/MVP</tt></p>

---

<p style="text-align:center"><tt>feature: serialization</tt></p>

Plans are serializable.

Serializable Plans can be sent over a wire or recorded to disk.

**serialize/deserialize API**: Provide APIs for serializing and deserializing a Plan.

Example pseudo-code:

    # Serialize the plan
    json = plan.serialize()
    
    # Create a new Plan from json
    plan = Plan(json)

**JSON serialization**: A serialized Plan is represented in JSON.

<p style="text-align:center"><tt>/feature: serialization</tt></p>
