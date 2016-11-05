---
layout: page
title: TransitionDirector
status:
  date: Oct 25, 2016
  is: Drafting
availability:
  - platform:
    name: iOS
    label: "transitions-objc as of v1.0.0"
    url: https://github.com/material-motion/material-motion-transitions-objc
---

# TransitionDirector specification

This is the engineering specification for the `TransitionDirector` type.

## Overview

A `TransitionDirector` creates the plans that shape a transition's motion and interaction.

## Features

* [Context element](feature_context_element)
* [Transition preconditions](feature_transition_preconditions)
* [Replication](feature_replication)

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
