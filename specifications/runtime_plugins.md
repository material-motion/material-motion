Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# Runtime plugins

## Events

A Runtime should generate events. These events should be observable by external entities.

### Event: activity state did change

Any time the Runtime changes its idle/active state it should fire an observable event.

This event enables "Transition Directors".

### Event: new target

The Runtime should send an event each time a new target is referenced.

The receivers of this event should be allowed to set a new "shadow" instance of the target. The shadow instance will be provided to the Actors.

This event enables "view duplication".
