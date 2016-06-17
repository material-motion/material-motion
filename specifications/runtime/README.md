# Motion Runtime

The system described here emphasizes a separation of plan from its execution. We call it a Motion Runtime, or Runtime for short.

The purpose of a Runtime is to coordinate the expression of diverse types of motion and interaction. It is an abstraction layer between the application engineer and execution systems.

The following diagram shows where the Runtime lives in relation to a platform like iOS.


![](../../_assets/Abstraction.svg)

## Overview

A Runtime is an object that collaborates with three other objects:

- Plans
- Executors
- Transactions

![](../../_assets/RuntimeOverview.svg)

Plans are added to Transactions.

Transactions are committed to Runtimes.

Runtimes create Executors.

Plans and Executors are best described as abstract protocols. Abstract base classes are a reasonable fall-back. Plans and Executors represent plan and execution, respectively. 

Transactions and Runtimes are both concrete objects.

### Plan

A plan is represented in the Runtime by an instance of Plan.

Example Plan objects:

- `SquashAndStretch` describes a target squashing and stretching in the direction of its movement.
- `Tween` describes a tween animation.
- `Draggable` describes gestural translation.
- `AnchoredSpring` describes a physical simulation.

Learn more about [Plans](plans.md).

### Executors

Executors are objects created by a Runtime. Executors are expected to translate Plans into execution.

Learn more about [Executors](Executors.md).

### Transactions

Transactions are the mechanism by which Plans are committed to a Runtime.

Learn more about [Transactions](transactions.md).

## Open topics

The following topics are open for discussion. They do not presently have a clear recommendation.

- When should Executors be removed from a Runtime?

<!--

LGTM:
- featherless
- markwei

-->
