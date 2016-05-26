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

## Outline (notes, not final copy)

TODO: The following content is an outline and needs to be folded into the above content.

- Runtime can have many Directors. Allow multiple Directors to share Actors. 
- Directors receive following events: 
    - Registration - expected to register intentions in this phase 
    - Input handling - may register new intentions 
- Actors receive following events from Runtime: 
    - Initialization 
    - Display link pump -&gt; returns Bool indicating “isActive?” 
    - Gesture events 
- Actor types include: 
    - Gestural actors 
    - Simulation actors 
    - Event actors 
        - Must have way to communicate to Runtime when the Actor becomes inactive (emphasis: this supports “external” animation systems like Core Animation) 

- Intention registration mechanism 
    - Associates intentions with elements 
    - Intentions can be added to elements permanently 
    - An array of intentions can be added to an element with a name 
        - Named intentions allow for “state” changes 
        - Adding named intentions will remove all previous intentions for that element with the same name 

- Runtime receives all Intention requests from the Director, then creates all the necessary Actors to execute those requests 
- Runtime may hook in to the refresh rate for a screen and use this as a simulation pump. This pump will only be provided to actors (emphasis: not the director) 
- Support the following states: 
    - Initializing 
    - Idle - no actors are currently causing changes to the system (emphasis: includes no “active” gesture recognizers) 
    - Active 

- Support the following state changes: 
    - Initializing -&gt; Idle|Active 
    - Idle -&gt; Active 
    - Active -&gt; Idle 

- Support Pausing the runtime 
- Support enumerating all registered intentions, elements, and actors 
    - Can be used to generate a console dump 
    - Can be used to build inspectors 

- Plugin system should enable listening to key events in a Runtime: 
    - When a new element has received intention, allow returning a new element that should be used instead (emphasis: this is for view duplication support) 
    - When a runtime’s current state has changed 

- Runtime should always be evaluating current “energy level” of the system. If Runtime reaches a steady state, this should be an event. (emphasis: allows other systems to react to runtime completion such as transitions) 
- Runtime should support some semblance of Actor priority. 
    - Unclear what this looks like, but order of Actor execution could potentially matter. Assumption presently is that Actors execute Intention in order that they were registered. 

- Existing Runtimes: 
    - Core Animation 
    - Android’s animation system 
    - Web animations

## Plugins

### Transition

Coordinates events with the operating system’s existing transition system.

Required events:

- Did start 
- Did idle 


### View duplication

Required events:

- First-time registration of Intention to element 

## Other systems

### Transition coordination

This system allows you to define which Directors to use for a transition between two “Screens” in an application.

- Discuss the “Narrator” concept.