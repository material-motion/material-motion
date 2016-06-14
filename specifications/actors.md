Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# Actors

**Initialization**: Runtimes create Actors. The Runtime provides the target to the Actor during initialization.

**Intentions**: Intentions may be provided to Actors as they're committed to the Runtime.

**Named Intentions**: Actors may choose to support named Intentions. When a named Intention is committed to a runtime, two things must happen:

1. The Actor must be asked to remove any Intention with the given name.
2. The actor must be provided with the new named Intention.

