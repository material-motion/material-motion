---
layout: page
---

## Applied forces

**What it is**: *the application of physical forces to a simulated body*.

The body consists of both a position and a velocity. Physical forces can be applied to the body's velocity over time using a numerical integrator. ([RK4](https://en.wikipedia.org/wiki/Runge%E2%80%93Kutta_methods) is one such integrator).

**Common forces**: The most common forces for software interfaces are:

- [Damped harmonic oscillators](https://en.wikipedia.org/wiki/Harmonic_oscillator#Damped_harmonic_oscillator) (Springs)
- Laminar [drag](https://en.wikipedia.org/wiki/Drag_(physics)) (Friction)

**Custom forces**: An applied force system can express arbitrary forces. Forces take the form `F = ma`, or force equals mass times acceleration.
