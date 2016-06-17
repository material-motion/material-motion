Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# Actors

Actors are the objects responsible for executing Intention.

**Who creates them?** `v1`: Runtimes create Actors.

**When are they created?** `v1`: When a transaction is committed.

**Initialization** `v1`: The Runtime initializes the Actor by providing a target instance.

Every other method described below should be **optional** for the Actor.

## Intention

**Intentions** `v1`: Intentions may be provided to Actors as they're committed to the Runtime.

Example pseudo-API available on the Actor:

    Actor {
      function addIntention(intention)
    }

Example pseudo-code from within the Runtime:

    actor = actorForIntention(intention)
    actor.addIntention(intention)

**Named Intentions** `feature: named`: Actors may choose to support named Intentions. When a named Intention is committed to a target, two things must happen:

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
