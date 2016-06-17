# Plans

A Plan is an object representing **what you want something to do**.

A Plan is the *plan* part of the separation of plan/execution.

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
