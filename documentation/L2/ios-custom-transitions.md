---
layout: docs
status:
  date: January 3, 2017
  is: Drafting
---

# Custom transitions with Material Motion in iOS

## Outline

### Introduction

1. Introduce concept of a custom transition director.
2. Example of building a custom slide-in transition where the background scales out.

### Making use of context views

1. Introduce concept of context views from a director's perspective.
2. Example of implementing a contextual transition.

### Failable directors

1. Introduce concept of directors that can choose to fail to drive a transition.
2. Example of implementing a contextual transition that fails when the contextual view is missing.
3. Explain how if all directors fail to drive a transition, we fall back to the system default.
