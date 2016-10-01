Status of this document:
![](../../_assets/under-construction-flashing-barracade-animation.gif)

# Scheduler tracing feature specification

## Overview

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

TODO.
