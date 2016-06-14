Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# Actors

**Initialization**: Runtimes create Actors. The Runtime provides the target to the Actor during initialization.

## Intention

**Intentions**: Intentions may be provided to Actors as they're committed to the Runtime. Example pseudo-code:

    actor = actorForIntention(intention)
    actor.addIntention(intention)

**Named Intentions**: Actors may choose to support named Intentions. When a named Intention is committed to a target, two things must happen.

1. Remove any previously committed target with the same name. This may be on a different Actor instance.
2. Provide the relevant Actor with the new named Intention.

Example pseudo-code:

    # Step 1
    actorForName(name).removeIntentionWithName(name)
    
    # Step 2
    actor = actorForIntention(intention)
    actor.setIntention(intention, withName: name)
    actorForName(name) = actor
