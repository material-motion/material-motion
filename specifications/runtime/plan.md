# Plan specification

This is the engineering specification for the `Plan` abstract type.

A plan is an object representing **what you want something to do** or **how you want it to behave**.

Example plan objects:

- `SquashAndStretch` describes a target squashing and stretching in the direction of its movement.
- `Tween` describes a tween animation.
- `Draggable` describes gestural translation.
- `AnchoredSpring` describes a physical simulation.

Printable tech tree/checklist:

![](../../_assets/PlanTechTree.svg)

## MVP

**Abstract type**: `Plan` is a protocol, if your language has that concept.

Pseudo-code example:

    protocol Plan {
    }

**Performer type API**: Provide an API that returns an instantiable type of performer that can execute this plan.

Pseudo-code example:

    protocol Plan {
      var performerType
    }

**Copyable**: Plans can be copied.

Modifications made to the copy do not affect the original.

This can be implemented in a variety of ways. We've included a few options below:

- Immutable types.
- Value types.
- Implement a copy or clone method on a reference type.

## Features

- [Serialization](plan-serialization.md)
