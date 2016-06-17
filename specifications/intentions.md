# Intentions

An Intention is an object representing **what you want something to do**.

An Intention is the *plan* part of the separation of plan/execution.

**Configuration**: Intentions can have configurable properties.

Pseudo-code example:

    Tween: Intention {
      var fromValue
      var toValue
    }

**Execution**: Actors execute Intentions.

This separation of concerns encourages reusable code.

**Serialization**: Intentions may be serializable.

Serializable Intentions can be sent over a wire or recorded to disk.
