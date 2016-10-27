# TransitionDirector specification

| Discussion thread | Status |
|:------------------|:-------|
| ![](../../../_assets/under-construction-flashing-barracade-animation.gif) | Drafting as of Oct 25, 2016 |

This is the engineering specification for the `TransitionDirector` type.

## Overview

A `TransitionDirector` creates the plans that shape a transition's motion and interaction.

## Features

* [Context element](feature_context_element.md)
* [Transition preconditions](feature_transition_preconditions.md)
* [Replication](feature_replication.md)

## MVP

**Abstract type**: `TransitionDirector` is a protocol, if your language has that concept.

Example pseudo-code:

```
protocol TransitionDirector
```

**Initialization API**: Define a required API that allows a director to receive a `Transition` instance.

Example pseudo-code:

```
protocol TransitionDirector {
  init(transition: Transition)
```

**setUp API**: Define a required API that allows a director to set up its initial plans.

Example pseudo-code:

```
protocol TransitionDirector {
  function setUp()
```
