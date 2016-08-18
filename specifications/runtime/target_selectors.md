Status of this document:
![](../../_assets/under-construction-flashing-barracade-animation.gif)

# Target selectors

## Transaction specification

Transactions may receive target selectors.

**selector APIs**: All add/remove APIs may be provided with a TargetSelector instead of a direct target.

Example pseudo-code:

    # Associate a named plan with a target.
    transaction.add(plan, TargetSelector("#contextView"))
    
    # Remove any named plan from a target.
    transaction.remove(name, TargetSelector("#contextView"))

## Scheduler specification

Support committing plans to targets using **target selectors**.

A **target selector** is a string that uniquely identifies one or more targets.

Examples:

- `#contextView`: The context view for a transition.
- `Grid Photo`: All Photo children contained within a Grid.

**Registration API**: Provide an API for associating names with targets.

This API is the mechanism by which the selector tree is defined.

    func associateNameWithTarget(name, target)

**Lookup API**: Provide an API for looking up targets with a given selector.

This API is meant to be used by the `commit` implementation to resolve specific targets when provided with a target selector.

    func targetsForSelector(selector) -> [Targets]
