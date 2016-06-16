# Intentions

A plan is represented in the Runtime by an instance of Intention.

**Example Intention objects**:

- `SquashAndStretch` describes a target squashing and stretching in the direction of its movement.
- `Tween` describes a tween animation.
- `Draggable` describes gestural translation.
- `AnchoredSpring` describes a physical simulation.

**Configuration**: Intentions can have configurable properties.

**Portability**: Intentions should be encodable. An Intention should be transferable over a network and to/from permanent storage.

**Execution**: Actors execute Intentions.

