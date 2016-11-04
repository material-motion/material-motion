---
layout: page
title: Primitives
permalink: /starmap/specifications/primitives/
---

# Motion primitives

This section explores some **building blocks** of rich, interactive motion.

This section's topics:

- [Tweens](#tweens)
- [Gesture recognition](#gesture-recognition)
- [Applied forces](#applied-forces)
- [Timeline](#timeline)
- [State Machine](#state-machine)

Most of these primitives represent change over time.

> Time in a computer is not limited to wall-clock time - it can slow down, stop, or reverse. It can jump to arbitrary moments and external systems can control it. When we use the word time we mean this understanding of "computer time".

Please note that these primitives can apply to an arbitrary number of dimensions and types of input.

## Tweens

**What it is**: *an interpolation through each value in a list of values over a length of time*.

Tweens have a **starting time** and a **duration**. The starting time and duration properties allow tweens to be sequenced in relation to other tweens.

Tweens use an **interpolation function**. This is often a cubic-bezier, but could be any mathematical equation accepting time as an input.

## Gesture recognition

**What it is**: *recognition of continuous or discrete actions from a stream of device input events*.

**Registration**: A gesture recognizer can be attached to an element.

**Interpreting events**: Gesture recognizers transform input events into meaningful outputs. The output is often a linear transformation of translation, rotation, and/or scale.

**Frequency of recognition**: Gestures may be recognized continuously (many times) or discretely (once).

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

**Velocity**: Continuous gesture recognizers include a velocity in each event. When a gesture's state becomes `recognized`, its velocity may be fed into applied forces.

## Applied forces

**What it is**: *the application of physical forces to a simulated body*.

The body consists of both a position and a velocity. Physical forces can be applied to its velocity over time using a numerical integrator. ([RK4](https://en.wikipedia.org/wiki/Runge%E2%80%93Kutta_methods) is one such integrator).

**Common forces**: The most common forces for software interfaces are:

- [Damped harmonic oscillators](https://en.wikipedia.org/wiki/Harmonic_oscillator#Damped_harmonic_oscillator) (Springs)
- Laminar [drag](https://en.wikipedia.org/wiki/Drag_(physics) (Friction)

**Custom forces**: An applied force system can express arbitrary forces. Forces take the form `F = ma`, or force equals mass times acceleration.

---

The following primitives are more structural in nature than the primitives described above.

## Timeline

**What it is**: *an object that contains a floating-point value, the progress*.

**Normalized progress**: A timeline's progress is "normalized" to a `[0...1]` range.

**Extending past the timeline**: A timeline's progress can extend beyond its bounds. What this means to objects observing the timeline is implementation-dependent. For example:

- **Fade** does not extend beyond 0 or 1 and can clamp to `[0...1]`.
- **Move** may extend beyond 0 or 1 and may not clamp at all.

## State Machine

**What it is**: *a [directed graph](https://en.wikipedia.org/wiki/Directed_graph) consisting of multiple States (nodes) with Transitions (edges) between those states*.

Typical phone applications utilize full-screen transitions between views. Each view is a distinct application state:

    A → B → C → D

Each arrow in the above diagram is a Transition, each letter is a State.

It is generally possible to move in the other direction:

    A ← B ← C ← D

**Transitions** always consist of exactly **two** States and a **direction**.

    A → B is a Transition  from  State A to    State B
    A ← B is a Transition  to    State A from  State B

Only the **direction** changes between the two lines above. We encourage thinking about transitions in terms of what's on the "left" and what's on the "right". This allows the direction to be thought of in terms of "to the left" or "to the right".
