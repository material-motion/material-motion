# Runtimes

This section explores one specification for a **declarative motion engine**.

## Overview

The purpose of a Runtime is to **coordinate** the expression of Plans in an application. We will apply the [Plan/Fulfillment](patterns/plan-fulfillment.md) and [Coordinator/Plan](patterns/coordinator-plan.md) patterns to the design of this system.

Throughout this chapter we will apply a metaphor oriented around theater terminology. The metaphor primarily consists of **Directors**, **Actors**, and **Intentions**.

- A Director is a **coordinator**.
- An Intention is a **plan**.
- An Actor is expected to **fulfill** Intentions.

Directors register Intentions with a Runtime. The Runtime creates Actors and passes a variety of events to them. These events allow Actors to fulfill their Intentions.

![Runtime](../_assets/RuntimeDiagram.png)  
