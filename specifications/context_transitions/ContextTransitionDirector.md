# ContextTransitionDirector specification

| Discussion thread | Status |
|:------------------|:-------|
| ![](../../_assets/under-construction-flashing-barracade-animation.gif) | Drafting as of Oct 25, 2016 |

This is the engineering specification for the `ContextTransitionDirector` type.

## Overview

A `ContextTransitionDirector` creates the plans that shape a transition's motion and interaction.

## Features

* [Context element](feature_context_element.md)
* [Transition preconditions](feature_transition_preconditions.md)
* [Replication](feature_replication.md)

## MVP

**Abstract type**: `ContextTransitionDirector` is a protocol, if your language has that concept.

Example pseudo-code:

```
protocol ContextTransitionDirector
```

**Initialization API**: Define a required API that allows a director to receive a `ContextTransition` instance.

Example pseudo-code:

```
protocol ContextTransitionDirector {
  init(transition: ContextTransition)
```

**setUp API**: Define a required API that allows a director to set up its initial plans.

Example pseudo-code:

```
protocol ContextTransitionDirector {
  function setUp()
```
