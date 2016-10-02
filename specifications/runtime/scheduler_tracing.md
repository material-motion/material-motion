Status of this document:
![](../../_assets/under-construction-flashing-barracade-animation.gif)

# Scheduler tracing feature specification

This is the engineering specification for the `Tracer` abstract type.

## Overview

Tracing is a form of logging in which information is recorded about a program's execution. Tracing can be used for debugging code, writing unit tests, and building user interfaces representing the current state of a system.

Tracing can be enabled on a scheduler by providing an instance of an object that conforms to the `Tracer` type.

This tracer protocol should methods like so:

```
func didCreatePerformer(named: String)
func didAdd(plan: Plan, toPerformerNamed: String)
etc...
```

You should be able to add a tracer to the scheduler like so:

```
scheduler.add(tracer:MyTracerImplementation())
```

A tracer can then do anything from logging the events to the console, e.g. a `LogTracer`, to sending events over the wire to a debugging tool.

We should provide a default tracer that simply allows you to enumerate all of the events as objects.

## MVP

**AddTracer API**: The scheduler should provide an API for registering a new tracer instance.



