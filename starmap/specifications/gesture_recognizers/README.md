---
layout: page
title: Gesture recognizer specification
knowledgelevel: L2
library: gestures
permalink: /starmap/specifications/gesture_recognizers/
status:
  date: December 20, 2016
  is: Stable
---

# Gesture recognizer specification

A gesture recognizer generates continuous or discrete events from a stream of device input events.
This specification describes the MVP expectations for a gesture recognition system.

## MVP expectations

### Able to be attached to an element

When attached to an element, any interactions with that element will be interpreted by the gesture
recognizer and turned into gesture events.

### Support continuous and discrete types

Gestures may be recognized continuously (many related events over time) or discretely (once).

The output might be a location, translation, rotation, or scale. It should not generate all types of
output simultaneously.

### Support active and at rest states

Gestures may be active or at rest. A continuous gesture is active for a period of time until it
comes to rest. A discrete gesture is instantaneously active and then at rest.

### Velocity

Continuous gesture recognizers include a velocity with each event.
