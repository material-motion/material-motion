---
layout: page
title: How to connect primitives
---

## How to connect primitives

We use "**to drive**" to refer to the idea of *an output from one primitive being fed into the input of another*. This enables the expression of novel interactions such as a gesture driving a timeline that is driving a collection of tweens.

#### Primitives that can drive timelines

A timeline's **progress** can be driven by the following primitives if they have been mapped to a domain of `[0...1]`:

- **Time** can move `progress` forward or backward.
- **Gestures** can scrub `progress` directly.
- **Applied forces**: `progress` can be physically anchored to a position, usually 1 or 0, using a Spring. This allows a timeline to snap to completion.
- **Applied forces** and **Gestures**: feeding the final velocity of a gesture into a applied forces allows the timeline to be tosse".
- **Tweens**.

#### Timelines can drive these primitives

The timeline's progress can drive tweens. For example: a fade-in animation could occur during the first 50% of a timeline. Scrubbing the timeline would scrub the animation as well.

Similarly, a timeline could be used to emit gesture events that simulate user input.  This pattern could be useful for teaching a user how to perform a gesture or for automated testing. 

#### Applied forces and states

Applied forces can be associated with individual states of a state machine.

> For example, a photo element might have two states: collapsed and expanded. A spring could be used to transition between them by changing the dimensions and position of the photo to match the correct state.

#### Timelines and transitions

Timelines are a helpful metaphor for constructing transitions.

> For example, a transition between state A and B might have a timeline that drives a coordinated set of tweens. There might also be ephemeral tweens created in response to user input during the transition.
