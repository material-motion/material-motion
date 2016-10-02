Status of this document:
![](../../_assets/under-construction-flashing-barracade-animation.gif)

# Scheduler tracing feature specification

This is the engineering specification for the `Tracer` abstract type.

## Overview

Tracing is a form of logging in which information is recorded about a program's execution. Tracing can be used for debugging code, writing unit tests, and building user interfaces representing the current state of a system.

Tracing can be enabled on a scheduler by providing an instance of an object that conforms to the `Tracer` type.

## MVP

### Scheduler

**AddTracer API**: The scheduler should provide an API for registering a new tracer instance.

Example pseudo-code:

```
class Scheduler {
  function addTracer(Tracer)
}
```

### Tracer

**Abstract type**: Provide an abstract type named `Tracer`.



