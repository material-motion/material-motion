# Motion family

A motion family is a software library that includes one or more Plans and Performer implementations.

## Minimum requirements

For a library to be called a motion family it must satisfy the following minimal requirements:

* Provide at least one Plan and Performer type.
* Define all Performer types as private to the library.
* Depend on the Runtime.
* Provide examples for every available Plan.

## Compositional families

A compositional family is one that is able to commit new plans to the runtime. 

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
    // Allow the runtime to know when the plan is active
    token = self.willStart()
    plan.addCompletionHandler {
      self.didEnd(token)
    }

    target.addSystemAnimation(plan)
  }
}
```

## 

