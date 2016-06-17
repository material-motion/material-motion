Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# Executors

Executors are the objects responsible for executing Intention.

`v1` **Who creates them?**: Runtimes create Executors.

`v1` **When are they created?**: When a transaction is committed.

`v1` **Initialization**: The Runtime initializes the Executor by providing a target instance.

Every other method described below should be **optional** for the Executor.

## Intention

`v1` **Intentions**: Intentions may be provided to Executors as they're committed to the Runtime.

Example pseudo-API available on the Executor:

    Executor {
      function addIntention(intention)
    }

Example pseudo-code from within the Runtime:

    Executor = ExecutorForIntention(intention)
    Executor.addIntention(intention)

`feature: named` **Named Intentions**: Executors may choose to support named Intentions. When a named Intention is committed to a target, two things must happen:

1. Remove any previously-committed Intention with the same name from the target's Executors. This may be on a different Executor instance.
2. Provide the relevant Executor with the new named Intention.

Example pseudo-API available on the Executor:

    Executor {
      function addIntention(intention, withName: name)
      function removeIntentionWithName(name)
    }

Example pseudo-code from within the Runtime:

    # Step 1
    ExecutorForName(name).removeIntentionWithName(name)
    
    # Step 2
    Executor = ExecutorForIntention(intention)
    Executor.setIntention(intention, withName: name)
    ExecutorForName(name) = Executor
