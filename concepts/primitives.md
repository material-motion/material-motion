# Primitives

This section explores **essential building blocks** of rich, interactive motion.

This section’s topics:
  
- [Delta Primitives](#delta-primitives)
- [Timeline](#timeline)
- [State Machine](#state-machine)

## Delta Primitives

Delta Primitives represent change over time.

> Time in a computer is not limited to wall-clock time - it can slow down, stop, or reverse. It can jump to arbitrary moments and external systems can control it. When we use the word time we mean this understanding of "computer time".

We explore the following Delta Primitives below:

- [Tweens](#tweens)
- [Gesture recognition](#gesture-recognition)
- [Physical simulation](#physical-simulation)

Please note that these Primitives can apply to an arbitrary number of dimensions and types of input.

### Tweens

**What it is**: *an interpolation through each value in a list of values*.

Tweens have a **starting time** and a **duration**. The start and duration properties allow tweens to be sequenced in relation to other tweens.

Tweens use an **interpolation function**. This is generally a cubic-bezier.

A **keyframe animation** is a Tween that animates between two or more values.

### Gesture recognition

**What it is**: *recognition of continuous or discrete actions from a stream of device input events*.

**Registration**: Gesture recognizers can be associated with a specific element. Once associated, interactions with the given element will be interpreted by the gesture recognizer. Interpreted values will be generated when the gesture is recognized. Gestures may be recognized continuously (many times) or discretely (once).

**Simultaneous gesture recognition**: Multiple gesture recognizers can be associated with a single element. All associated gesture recognizers should be capable of generating values simultaneously. For instance:

> Two pan gestures are registered to a carousel:
> 
> - horizontal pans move between items in the carousel, and
> - vertical pans collapse or expand the carousel.
> 
> Both gestures can occur simultaneously.

**Gesture dependencies**: Gesture recognizers can defer recognition until other
recognizers have failed. For instance:

> An element can both be tapped and double-tapped; tap is deferred until the failure of double-tap.

**Velocity**: Continuous gesture recognizers emit a velocity each time the gesture generates a new interpreted value. Once a gesture has ended, its velocity may be fed into a Physical Simulation.

### Physical simulation

**What it is**: *the application of physical forces to a simulated body consisting of both a position and velocity*.

Forces can be applied to the physical body’s velocity over time using a numerical integrator. ([RK4](https://en.wikipedia.org/wiki/Runge%E2%80%93Kutta_methods) is one such integrator).

**Common forces**: The most common types of forces for software interfaces are:

- [Damped harmonic oscillators](https://en.wikipedia.org/wiki/Harmonic_oscillator#Damped_harmonic_oscillator) (Springs)
- Laminar [drag](https://en.wikipedia.org/wiki/Drag_(physics) (Friction)
- [Collisions](https://en.wikipedia.org/wiki/Collision_detection)

**Custom forces**: A physical simulation system should also allow for the expression of arbitrary forces.

## Timeline

**What it is**: *an entity that contains a floating-point value, which can be driven by a Delta Primitive, and to which Tweens may be associated*.

A Timeline limits its value, **progress**, between 0 and 1.

We use “**to drive**” to refer to the idea of *an output from one Primitive being fed into the input of another*. This enables the expression of novel interactions such as a Gesture driving a Timeline that is driving a collection of Tweens.

#### Primitives driving the progress

The **progress** can be driven by the following Delta Primitives if they have been mapped to a domain of `[0...1]`:

- **Time** can move the progress forward or backward.
- **Gestures** can scrub the progress directly.
- **Physical simulation**: The progress can be physically anchored to a position, usually 1 or 0,
  using a Spring. A Gesture primitive’s final velocity can also be fed into this simulation.
- **Tweens** can drive the progress.

#### Progress driving Primitives

The progress can drive Tween Primitives. For example: a fade-in tween animation could occur during the first 50% of a timeline.

There is no known benefit to driving Gestural or Physical Simulation Primitives with a Timeline; it is also not particularly clear what that would mean.

## State Machine

**What it is**: *a [directed graph](https://en.wikipedia.org/wiki/Directed_graph) consisting of multiple States (nodes) with Transitions (edges) between those states*.

Typical phone applications utilize full-screen transitions between views. Each view is a distinct application state:

```A → B → C → D```

Each arrow in the above diagram is a Transition, each letter is a State.

It is generally possible to move in the other direction:

```A ← B ← C ← D```

**Transitions** always consist of exactly **two** States and a **Direction**.

```
A → B is a Transition from State A to State B.

A ← B is a Transition to State A from State B.
```
Physical Simulations can be associated with States.

> For example, a photo element might have two states: collapsed and expanded. Both states have spring attachments that change the dimensions and position of the photo. Changing the state to expanded would cause the expanded state springs to be attached to the view.

Tweens and Timelines can be associated with Transitions.

> For example, a Transition between state A and B might have a Timeline that drives a coordinated set of Tweens. There might also be one-off Tweens that occur when transitioning from A to B and vice versa.