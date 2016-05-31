# Runtimes

This section explores one specification for a **declarative motion engine**.

## Overview

The purpose of a Runtime is to **coordinate** the expression of Intention in an application. Coordination is made possible because of a combination of the Director/Intention + Intention/Actor Patterns.

The Director **registers** Intentions with a Runtime; the Runtime creates Actors and gives them life.

![Runtime](../_assets/RuntimeDiagram.png)  
A Runtime requires at least one instance of a Director. A Runtime may have many Director instances.

Each Director may register an initial set of Intentions in a setup method.

After the Director registers its Intentions, the Runtime creates a collection of Actors that are able to fulfill the contract of the Intentions.

> TODO: There must exist some mechanism by which Intention and Actors are associated. The question that the Runtime will need to ask is “Which Actor can execute these Intentions?” This is being discussed in [#8](https://www.gitbook.com/book/material-motion/material-motion-starmap/discussions/8).

The Runtime now has a collection of Actors.

The Runtime is now responsible for forwarding events to Actors. (Link to Actor events).

A Runtime is constantly measuring the amount of energy in the system. Energy is defined as "the number of active Actors". If there is no energy then the Runtime should enter an idle state. This is an important part of minimizing battery consumption on mobile devices. (Link to Runtime states).

## Intention registration

TODO: Discuss how Intentions are registered with the system. Specifically, discuss how Intentions should interact with Plugins like view duplication.

## Director events

### Setup

### Teardown

### Gesture recognition

Directors may listen to Gesture Recognizer events in order to facilitate high-level coordination of Intentions.

## Runtime states

- Initializing
- Idle
- Active

## Actor state

- The direct target (what the Actor was initially registered to).
- The dynamic target (may not be the target).
- Permanently-registered Intentions.
- Intentions registered by name.

## Actor events

The Runtime identifies which events each Actor expects to receive. Events include:

- intention registration,
- animation events, and
- gesture recognition events.

### Intention registration

TODO: Discuss adding permanent intentions.

TODO: Discuss adding named intentions.

### Animation

The animate event is invoked when the system is about to render a new frame. This event is often called many times per second.

Each Actor is responsible for calculating time deltas. Take care to respect platform animation speed scalars.

### Gesture recognition

The gesture event is invoked when a gesture recognizer's state has changed.

## Plugins

TODO: Write an intro. Emphasize that plugins are one of the most platform-specific parts of a runtime.

### Plugin events

#### Runtime state changed

- Useful for transition system handoff.

#### Actor created for target

- Useful for view duplication. This event must allow the plugin to change the "associated target" for all Actors referencing a given target.

### Specific plugins

#### View duplication

TODO: Discuss when view duplication hooks into the system. Emphasize the need to hook in to intention registration events with new elements in the system.

Required events:

- First-time registration of Intention to element 

#### Transition

Coordinate events with the operating system’s existing transition system.

Required events:

- Did start 
- Did idle 

## Companions to a Runtime

TODO: Write an intro. These systems coordinate the creation of Runtimes in reaction to other events. The most simple example is that of a "Transition" coordinator.

### Transition coordination

This system allows you to define which Directors to use for a transition between two “Screens” in an application.

- Discuss the “Narrator” concept.


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
