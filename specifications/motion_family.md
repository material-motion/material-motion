# Motion library

A **motion library** is a software library that includes one or more Plan and Performer implementations.

## Minimum requirements

For a library to be called a motion library it must satisfy the following minimal requirements:

* Provide at least one Plan and Performer type.
* Define all Performer types as private to the library.
* Depend on the Runtime.
* Provide examples for every available Plan.

## Types of libraries

Libraries can be roughly categorized in two groups: bridges and custom.

### Bridging libraries

A motion library that delegates to an existing animation or interaction system is called a **bridge library**.

Bridge libraries are often the first libraries to be built for a platform.

Bridge libraries should provide the primitive plans described in the [motion language](plans/).

### Composition families

Emits new plans in reaction to specific events.

Composition families eventually reduce down to one or more delegation families.

