---
layout: docs
status:
  date: January 3, 2017
  is: Drafting
---

# Interactions with Material Motion in iOS

## Outline

### Introduction

1. Introduce concept of an Interaction.
2. Example of using a pre-packaged interaction:
   ```swift
   let interaction = DirectlyManipulableInteraction(view: someView)
   interaction.connect(with: runtime)
   ```

### Interaction catalog

1. List all available interactions.

### Graduation to L2

L2 involves creating custom interactions.
