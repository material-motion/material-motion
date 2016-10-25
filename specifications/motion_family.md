# Motion family

A **motion family** is a software library that includes one or more Plan and Performer implementations.

Motion families focus on motion for a **single element**. Use [Directors](directors.md) for motion concerning more than one element.

## Minimum requirements

For a library to be called a motion family it must satisfy the following minimal requirements:

* Provide at least one Plan and Performer type.
* Define all Performer types as private to the library.
* Depend on the Runtime.
* Provide examples for every available Plan.

## Types of families

Families can be roughly categorized in two groups: delegation and composition.

### Continuous families

Continuous execution via an external system.

**Platform-specific bridge families**

A motion family that delegates to an existing animation or interaction system is called a **bridge family**.

Bridge families are often the first families to be built for a platform.

Bridge families form the foundation upon which compositional families can be constructed.

### Composition families

Emits new plans in reaction to specific events.

Composition families eventually reduce down to one or more delegation families.

