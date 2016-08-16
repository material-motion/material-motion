# Transaction target selectors specification

Transactions may receive target selectors.

**selector APIs**: All add/remove APIs may be provided with a TargetSelector instead of a direct target.

Example pseudo-code:

    # Associate a named plan with a target.
    transaction.add(plan, TargetSelector("#contextView"))
    
    # Remove any named plan from a target.
    transaction.remove(name, TargetSelector("#contextView"))
