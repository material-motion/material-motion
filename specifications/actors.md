Status of this document: **Drafting by featherless**

# Actors

**Initialization**: Runtimes create Actors. The Runtime provides the target to the Actor during initialization.

**Optional methods**: Every method described below should be **optional** for the Actor.

## Intention

**Intentions**: Intentions may be provided to Actors as they're committed to the Runtime.

Example pseudo-API available on the Actor:

    Actor {
      function addIntention(intention)
    }

Example pseudo-code from within the Runtime:

    actor = actorForIntention(intention)
    actor.addIntention(intention)

**Named Intentions**: Actors may choose to support named Intentions. When a named Intention is committed to a target, two things must happen:

1. Remove any previously-committed Intention with the same name from the target's actors. This may be on a different Actor instance.
2. Provide the relevant Actor with the new named Intention.

Example pseudo-API available on the Actor:

    Actor {
      function addIntention(intention, withName: name)
      function removeIntentionWithName(name)
    }

Example pseudo-code from within the Runtime:

    # Step 1
    actorForName(name).removeIntentionWithName(name)
    
    # Step 2
    actor = actorForIntention(intention)
    actor.setIntention(intention, withName: name)
    actorForName(name) = actor
