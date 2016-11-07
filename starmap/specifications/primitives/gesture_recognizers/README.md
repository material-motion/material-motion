---
layout: page
title: Gesture recognizers
permalink: /starmap/specifications/primitives/gesture_recognizers/
---

# Gesture recognizers

A gesture recognizer generates continuous or discrete events from a stream of device input events.

## MVP expectations

### Able to generate gesture events

When attached to an element, any interactions with that element will be interpreted by the gesture
recognizer and turned into gesture events. The output is often a linear transformation of
translation, rotation, and/or scale.

### Support continuous and discrete types

Gestures may be recognized continuously (many times) or discretely (once).

### Velocity

Continuous gesture recognizers include a velocity with each event.

## Feature: multiple simultaneous gesture recognizers

Multiple gesture recognizers can be associated with a single element. All associated gesture
recognizers should be capable of generating values simultaneously. For instance:

> Two pan gestures are registered to an element:
> 
> - horizontal pans move between items in the element, and
> - vertical pans collapse or expand the element.
> 
> Both gestures might occur simultaneously.

## Feature: gesture dependencies

Gesture recognizers can defer recognition until other recognizers have failed. For instance:

> An element can both be tapped and double-tapped; tap is deferred until the failure of double-tap.
