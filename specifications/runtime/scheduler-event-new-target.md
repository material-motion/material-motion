Status of this document:
![](../../_assets/under-construction-flashing-barracade-animation.gif)

# New target event

Fire an observable event when a new target is referenced.

**new target API**: Provide a public API for adding a "new target" listener.

    Scheduler {
      public function addNewTargetObserver(function)
    }
    
    scheduler.addNewTargetObserver(function(target) {
      // Potentially clone the target
      return clonedTarget
    })

**Replicas**: Allow the event receiver to return a replica instance.

A replica instance is meant to be used in place of the original target.

One common use of this feature is *element replication*. The replica element can safely be modified with little consequence.

Performers are expected to act on the replica rather than the original target.
