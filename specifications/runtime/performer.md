# Performer specification

This is the engineering specification for the `Performer` abstract type.

|                  | Android | Apple |
| ---------------- |:-------:|:-----:|
| First introduced | [Runtime 1.0.0](https://github.com/material-motion/material-motion-runtime-android/releases)   | [Runtime 1.0.0](https://github.com/material-motion/material-motion-runtime-objc/releases/tag/v1.0.0) |

## Features

- [Named plans](named-plans.md)
- [Composition](performer-composition.md)

## Overview

Performers are the objects responsible for executing plans.

Printable tech tree/checklist:

![](../../_assets/PerformerTechTree.svg)

## MVP

**Abstract type**: `Performer` is a protocol, if your language has that concept.

Example pseudo-code:

    protocol Performer {
    }

**Not directly configurable**: Performers do not provide direct configuration methods.

Performers can only be configured by providing them with plans.

**Initialize with target**: Performers are initialized with a target.

Example pseudo-code:

    performer = Performer(target)

**Add plan API**: Define an optional API that allows performers to receive plans.

> If a performer cannot be configured, it will not expose this API.

Example pseudo-code:

    protocol PlanPerforming {
      function addPlan(plan)
    }

**Continuous Performing API**: Define an optional API that allows performers to indicate when some continuous work has started and when it eventually ends.

The scheduler uses the existence of any non-terminate is-active tokens to define its active/idle state.

> The performer may choose not to implement this API.

A continuous performer is responsible for requesting an is-active token and then terminating it once no longer needed. Consider the following examples:

- Generate a token before an animation begins and terminate the token when the animation completes.
- Generate a token when a gesture begins and terminate the token when the gesture completes.

Example pseudo-code:

    protocol ContinuousPerforming {
      function setIsActiveTokenGenerator(tokenGenerator)
    }
    
    class IsActiveTokenGenerator {
      function generate() -> IsActiveToken
    }
    
    class IsActiveToken {
      function terminate()
    }

---

## Proposed features

### Manual execution

A performer can choose to implement an update function that will be called many times per second.

**Manual execution API**: Define an optional API that allows performers to implement an update function.

> The performer may choose not to implement this API.

The update function will be called each time the platform will draw a new frame. The performer may use this method to perform time-based calculations. The performer is **not** expected to perform any rendering during this update event.

The method returns an activity state enumeration. This enumeration has two states: active and at rest.

Example pseudo-code:

    enum ActivityState {
      .Active
      .AtRest
    }
    
    protocol ManuallyExecutingPerformer {
      function update(millisecondsSinceLastUpdate) -> ActivityState
    }
