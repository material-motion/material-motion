# Intentions

An Intention is an object representing **what you want something to do**.

An Intention is the *plan* part of the separation of plan/execution.

`v1` **Configuration**: Intentions can have configurable properties.

Pseudo-code example:

    Tween: Intention {
      var fromValue
      var toValue
    }

`v1` **Execution**: Executors execute Intentions.

This separation of concerns encourages reusable code.

`feature: serialization` **Serialization**: Intentions may be serializable.

Serializable Intentions can be sent over a wire or recorded to disk.
