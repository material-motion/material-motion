# ContextTransitionDirector specification

This is the engineering specification for the `ContextTransitionDirector` type.

## Overview

A `ContextTransitionDirector` creates the plans that shape a transition's motion and interaction.

## Features

* [Context element](feature-context-element.md)
* [Transition preconditions](feature-transition-preconditions.md)
* [Replication](feature-transition-preconditions.md)

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
