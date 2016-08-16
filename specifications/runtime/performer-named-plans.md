# Performer named plans specification

Performers can receive named plans.

**Add/remove API**: Performers can implement an add/remove function.

>The Performer may choose not to implement this API.

If one method is implemented, so must the other.

Example pseudo-code:

    protocol NamedPlanExecution {
      function addPlanWithName(plan, name)
      function removePlanWithName(name)
    }
