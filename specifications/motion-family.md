# Motion family

A motion family is a software library that includes one or more Plans and Performer implementations.

## Minimum requirements

A motion family must satisfy the following minimal requirements:

* At least one Plan and Performer type.
* All Performer types are private to the library.
* Has a dependency on the Runtime.
* Examples for every available Plan.

## Platform-specific bridge families

Existing animation and interaction systems can and should be bridged to Material Motion. These motion families will form the foundation upon which more abstract motion families can be constructed.

Example pseudo-code implementation:

```
extend SystemAnimation: conforms to Plan {
  func performerClass() {
    return SystemAnimationPerformer.class
  }
}

SystemAnimationPerformer: Performer {
  func addPlan(plan) {
    // Register the plan's active state with the runtime
    token = self.willStart()
    plan.addCompletionHandler {
      self.didEnd(token)
    }

    target.addSystemAnimation(plan)
  }
}
```



