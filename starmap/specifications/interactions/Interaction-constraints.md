---
layout: page
title: Applying constraints to interactions
status:
  date: April 18, 2017
  is: Stable
interfacelevel: L2
implementationlevel: L4
library: material-motion
depends_on:
  - /starmap/specifications/observable/MotionObservable
  - /starmap/specifications/interactions/
---

# Applying constraints to interactions

This is the engineering specification for applying constraints to `Interaction` instances.

## Overview

Constraints are operators that are applied to interactions when they're added to a MotionRuntime.

```swift
runtime.add(Draggable(), to: view, constraints: { $0.xLocked(to: 100) })
```

Constraints can be added to one or more streams connected by the interaction.
