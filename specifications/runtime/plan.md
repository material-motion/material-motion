Status of this document:
![](../../../../_assets/under-construction-flashing-barracade-animation.gif)

# Plan specification

This is the engineering specification for the Plan object.

A Plan is an object representing **what you want something to do**.

A Plan is the *plan* part of the separation of plan/execution.

Example Plan objects:

- `SquashAndStretch` describes a target squashing and stretching in the direction of its movement.
- `Tween` describes a tween animation.
- `Draggable` describes gestural translation.
- `AnchoredSpring` describes a physical simulation.

**Protocol**: Represent Plans as an abstract protocol, if your language allows.

Pseudo-code example:

    protocol Plan {
    }

`v1` **Configuration**: Plans can have configurable properties.

Pseudo-code example:

    Tween: Plan {
      var fromValue
      var toValue
    }

`v1` **Execution**: Executors execute Plans.

This separation of concerns encourages reusable code.

`feature: serialization` **Serialization**: Plans may be serializable.

Serializable Plans can be sent over a wire or recorded to disk.
