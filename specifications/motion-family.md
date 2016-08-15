# Motion family

A motion family is a software library that includes one or more Plans and Performer implementations.

## Minimum requirements

For a library to be called a motion family it must satisfy the following minimal requirements:

* Provide at least one Plan and Performer type.
* Define all Performer types as private to the library.
* Depend on the Runtime.
* Provide examples for every available Plan.

## Composition families

A composition family is one that emits new plans in reaction to specific events.

## Delegation families

A delegation family is one that delegates execution to an external system.

A delegation family's performers are expected to conform to the DelegatingPerformer protocol.

### Platform-specific bridge families

Existing animation and interaction systems can and should be bridged to Material Motion. These motion families form the foundation upon which more abstract motion families can be constructed.

Bridge families are delegation families.

