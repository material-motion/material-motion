# Runtimes

This section explores one specification for a **declarative motion engine**.

The purpose of a Runtime is to **coordinate** the expression of Intention in an application. Coordination is made possible because of a combination of the Director/Intention + Intention/Actor Patterns. The Director **registers** Intentions with a Runtime; the Runtime creates Actors and gives them life.

![Runtime](../_assets/RuntimeDiagram.png)
A Runtime requires at least one instance of a Director. Each Director must be asked to register its initial set of Intentions.

> Directors are often provided with some subset of the application’s elements. This allows the Director to associate Intentions with specific elements. How these elements are provided to the Director is left as an exercise to the reader.

After the Director registers its Intentions, the Runtime creates a collection of Actors that are able to fulfill the contract of the Intentions.

> TODO: There must exist some mechanism by which Intention and Actors are associated. The question that the Runtime will need to ask is “Which Actor can execute these Intentions?” This is being discussed in https://github.com/material-motion/material-motion-starmap/issues/13.

The Runtime now has a collection of Actors and a Director. At this point the Runtime will identify the kinds of inputs each Actor requires. Input types include:

- Next frame render event.
- Gestural input.

If any Actor requires a render frame event then the Runtime will now hook the Display link. Each time the event fires, the Runtime will ask each Actor to execute its simulation. The Actor is expected to return a Boolean indicating whether it will require additional simulation events.

    function simulate(timestamp) -> Boolean

Actors that require gesture events will receive them as they happen.

    function gestureDidChange(gesture) -> Void

**On bespoke Actors vs Actors using external systems**: a Runtime’s primary value is in its ability to coordinate a variety of Intentions. While a Runtime does enable the creation of bespoke Intentions and Actors, we encourage the reader to identify and build abstractions that can stand alone from a Runtime.

