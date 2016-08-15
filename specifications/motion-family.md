# Motion family

A motion family is a software library that includes one or more Plans and Performer implementations.

Motion families focus on motion for a **single element**. Use [Directors](directors.md) for motion concerning more than one element.

## Minimum requirements

For a library to be called a motion family it must satisfy the following minimal requirements:

* Provide at least one Plan and Performer type.
* Define all Performer types as private to the library.
* Depend on the Runtime.
* Provide examples for every available Plan.

## Types of families

Families can be roughly categorized in two groups: delegation and composition.

### Delegation families

Delegates execution to an external system.

**Platform-specific bridge families**

Existing animation and interaction systems should be bridged to Material Motion using bridge families.

Bridge families form the foundation upon which compositional families can be constructed.

Bridge families often use delegation in order to connect the external system to the runtime's activity state.

### Composition families

Emits new plans in reaction to specific events.

Composition families eventually reduce down to one or more delegation families.

