# Intentions

An Intention is an object representing **what you want something to do**.

An Intention is the *plan* part of the separation of plan/execution.

**Configuration**: Intentions can have configurable properties.

Pseudo-code example:

    Tween: Intention {
      var fromValue
      var toValue
    }

**Serializable**: Intentions may be serializable.

Serializable Intentions can be transfered over a network and to/from permanent storage.

Pseudo-code example:

    Tween: Intention {
      function toJSON() -> JSON
      function fromJSON(JSON)
    }

**Execution**: Actors execute Intentions.

This separation of concerns encourages reusable code.
