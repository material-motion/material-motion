Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# Runtime plugins

## Events

Events observable by external entities.

### Idle ↔ Active state change

Any time the Runtime changes its Idle/Active state it should fire an observable event.

### New target referenced

Each time a new target is referenced, the Runtime should send an event. The receivers of this event should be allowed to return a new "shadow" instance of the target. This shadow instance will be provided to the Actors.

This event enables the "View duplication" plugin.
