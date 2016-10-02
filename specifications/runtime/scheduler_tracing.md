# Scheduler tracing feature specification

This is the engineering specification for the `Tracer` abstract type.

## Overview

Tracing is a form of logging in which information is recorded about a program's execution. Tracing can be used for debugging code, writing unit tests, and building user interfaces representing the current state of a system.

Tracing can be enabled on a scheduler by providing an instance of an object that conforms to the `Tracer` type.

## MVP

### Scheduler

**AddTracer and RemoveTracer APIs**: The scheduler should provide a APIs for adding and removing tracer instances.

Example pseudo-code:

```
class Scheduler {
  function addTracer(Tracer)
  function removeTracer(Tracer)
}
```

### Tracer

**Abstract type**: Provide an abstract type named `Tracer`.

Example pseudo-code:

```
Tracer {
}
```

**didAddPlan event**: The Tracer type can optionally implement a `didAddPlan` function.

Invoked by the scheduler when `addPlan` is about to return from its execution.

Example pseudo-code:

```
Tracer {
  optional function didAddPlan(Plan, to: Target)
}
```

**didCreatePerformer event**: The Tracer type can optionally implement a `didCreatePerformer` function.

Invoked by the scheduler after a new performer instance has been created.

Example pseudo-code:

```
Tracer {
  optional function didCreatePerformer(Performer, for: Target)
}
```

