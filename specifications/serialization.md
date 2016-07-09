Status of this document:
![](../_assets/under-construction-flashing-barracade-animation.gif)

# Serialization of plans

TODO: Define a specification for serializing plans.

Thoughts:

- It's not clear that there is benefit to forcing a standard means of serialization across all plan types across all families. E.g. "Let's use json for everything".
- It is clear that - within a given family - plans should be serializable across all platforms for which that family exists. For example, an abstract "Tween" family should be serializable across Android, Web, and iOS. A Core Animation family likely should not be.
- The spec for serialization should encourage defining serialization mechanisms within a given **family of plans**. We should provide a software design spec for Plans and some abstract "Serializing" entity. Such a serializing entity could hook up to a common system that thinks in terms of runtimes and serializing entities. This common system could read/write/transmit plans over the wire.
