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

# Simultaneous gesture recognition feature specification

Multiple gesture recognizers can be associated with a single element. All associated gesture
recognizers should be capable of generating values simultaneously. For instance:

> Two pan gestures are registered to an element:
> 
> - horizontal pans move between items in the element, and
> - vertical pans collapse or expand the element.
> 
> Both gestures might occur simultaneously.
