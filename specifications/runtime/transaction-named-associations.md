# Transaction named associations specification

Transactions support named add/remove operations.

**Named add API**: Provide an API for `add` and `remove` with a name argument.

Example pseudo-code:

    # Associate a named plan with a target.
    transaction.add(plan, target, name)
    
    # Remove any named plan from a target.
    transaction.remove(name, target)

**Order**: Maintain order of named operations.

Last operation wins.
