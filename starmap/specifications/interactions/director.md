---
layout: page
status:
  date: Oct 25, 2016
  is: Drafting
---

# Director

A director is an object whose primary purpose is to describe motion.

## Overview

"Director" does not have to be a formal base type. An object that emits Plans across a variety of targets can be considered a Director.

Directors have little — if any — imperative code that directly applies changes to targets. Directors prefer to describe motion indirectly via plans. Directors are expected to coordinate the registration of these plans.

## MVP

**Runtime API**: A director may be provided with a Runtime instance, or it might create its own.

**setUp API**: A director may implement a `setUp` function. This function is expected to be invoked exactly once.

Example pseudo-code definition:

```
function setUp()
```

Example pseudo-code implementation:

```
function setUp() {
  runtime.addPlan(plan, to: targetA)
  runtime.addPlan(plan, to: targetB)
  ...
}
```
