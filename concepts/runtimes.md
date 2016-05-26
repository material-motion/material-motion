# Runtimes

This section explores one specification for a **declarative motion engine**.

The purpose of a Runtime is to **coordinate** the expression of Intention in an application. Coordination is made possible because of a combination of the Director/Intention + Intention/Actor Patterns. The Director **registers** Intentions with a Runtime; the Runtime creates Actors and gives them life.

![Runtime](../_assets/RuntimeDiagram.png)
