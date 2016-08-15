# Motion family

A motion family is a software library that includes one or more Plans and Performer implementations.

Motion families focus on motion for a **single element**. Use [Directors](directors.md) for motion concerning more than one element.

## Minimum requirements

For a library to be called a motion family it must satisfy the following minimal requirements:

* Provide at least one Plan and Performer type.
* Define all Performer types as private to the library.
* Depend on the Runtime.
* Provide examples for every available Plan.

## Delegation families

A delegation family is one that delegates execution to an external system.

A delegation family's performers are expected to conform to the DelegatingPerformer protocol.

### Platform-specific bridge families

Existing animation and interaction systems should be bridged to Material Motion using bridge families.

Bridge families form the foundation upon which compositional families can be constructed.

Bridge families often use delegation.

## Composition families

A composition family is one that emits new plans in reaction to specific events.

Composition families eventually reduce down to one or more delegation families.

