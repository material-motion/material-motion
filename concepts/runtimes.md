# Runtimes

This section explores one specification for a **declarative motion engine**.

## Overview

The purpose of a Runtime is to **coordinate** the expression of [Plans](patterns/plan-fulfillment.md) in an application.

Throughout this chapter we will apply a metaphor oriented around theater terminology. The metaphor primarily consists of **Actors** and **Intentions**.

- An Intention is a **plan**.
- An Actor is expected to **fulfill** Intentions.

Directors register Intentions with a Runtime. The Runtime creates Actors and passes a variety of events to them. These events allow Actors to fulfill their Intentions.

![Runtime](../_assets/RuntimeDiagram.png)  
