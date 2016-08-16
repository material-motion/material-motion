# Named plans

## Performer specification

Performers can receive named plans.

**Add/remove API**: Performers can implement an add/remove function.

>The Performer may choose not to implement this API.

If one method is implemented, so must the other.

Example pseudo-code:

    protocol NamedPlanExecution {
      function addPlanWithName(plan, name)
      function removePlanWithName(name)
    }

## Transaction specification

Transactions support named add/remove operations.

**Named add API**: Provide an API for `add` and `remove` with a name argument.

Example pseudo-code:

    # Associate a named plan with a target.
    transaction.add(plan, target, name)
    
    # Remove any named plan from a target.
    transaction.remove(name, target)

**Order**: Maintain order of named operations.

Last operation wins.
