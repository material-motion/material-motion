This document's current status: Stable

## The Coordinator/Plan pattern

A **Coordinator** describes an interactive experience by creating Plans and associating them with targets.

> Imagine a transition between two states. A Coordinator might create a [Timeline](primitives.md) and associate many Tweens with elements in the scene.

Coordinators use Plans that may be fulfilled by any of the available [Primitives](primitives.md). This enables the expression of **coordinated interactions** involving gestures, animations, and physical simulation.

> Imagine a set of avatars as being draggable and, when not being dragged, the avatars gravitate toward the edges of a defined area. The Coordinator might associate a Draggable Plan with a given avatar. The Coordination might also associate a Spring Attachment Plan to the avatar once the user has released it.

**Multiple Coordinators** can affect a given set of elements. The software designer must choose reasonable lines of overlapping responsibility.

> Imagine a horizontal carousel that can be expanded full screen. One Coordinator might govern the horizontal movement of the carousel. Another Coordinator might govern the expansion/collapse of the carousel to/from full screen.

It is important that the Coordinator not be involved in the Fulfillment of any Plans. Coordinators generally live in the "application" space, while Fulfillments may occur anywhere else.

This pattern allows Coordinators to be written in a separate language from the application code (see: [Runtime](runtime.md)). It allows Coordinators to communicate over the wire between devices (see: [Applications](../applications/)).