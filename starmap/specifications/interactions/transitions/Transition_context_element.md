---
layout: page
title: "Transition context element"
status:
  date: Oct 25, 2016
  is: Drafting
---

# Transition context element feature specification

The context element is what that the user interacted with in order to initiate the transition.

## MVP

**Context element API**: Provide an API for retrieving the transition's context element.

Example pseudo-code:

```swift
Transition {
  readonly var contextElement
```
