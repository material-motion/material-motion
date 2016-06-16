Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# Runtime plugins

## Events

A Runtime should generate events. These events should be observable by external entities.

### Idle ↔ active state change

Any time the Runtime changes its idle/active state it should fire an observable event.

This is helpful for Transition Directors.

### New target referenced

Each time a new target is referenced, the Runtime should send an event. The receivers of this event should be allowed to return a new "shadow" instance of the target. This shadow instance will be provided to the Actors.

This event enables the "view duplication" plugin.
