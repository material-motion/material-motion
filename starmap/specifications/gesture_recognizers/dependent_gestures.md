---
layout: page
status:
  date: December 4, 2016
  is: Draft
knowledgelevel: L2
library: gestures
depends_on:
  - /starmap/specifications/gesture_recognizers/GestureRecognizer
---

# Gesture dependencies feature specification

Gesture recognizers can defer recognition until other recognizers have failed. For instance:

> An element can both be tapped and double-tapped; tap is deferred until the failure of double-tap.
