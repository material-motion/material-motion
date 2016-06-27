# Motion Runtime

This section defines a system that emphasizes the separation of a plan from its execution. We call it a Motion Runtime, or Runtime for short.

A Runtime serves two primary purposes:

- Provide an abstraction layer between the application engineer and execution systems.
- Coordinate the expression of diverse types of motion and interaction.

The following diagram shows where the Runtime lives in relation to a platform like iOS.

![](../../_assets/Abstraction.svg)

## Overview

A Runtime will find a way to execute any plans it is provided.

This sentence introduces two important questions:

1. How are plans provided to a Runtime?
1. How does a Runtime know how to execute plans?

To answer the first question we introduce two new types into the system: `Plan` and `Transaction`.

> A plan is an object representing **what you want something to do**. A transaction aggregates requests for plan-target associations.

To answer the second question we introduce two more types: the `Performer` and the `Scheduler`.

> An performer's sole responsibility is to fulfill the contract defined by one or more plans. A scheduler is the entity that creates performers.

Here's how these objects fit together:

1. Plans are added to transactions.
2. Transactions are committed to a scheduler.
3. Schedulers create performers.

In visual form:

![](../../_assets/RuntimeOverview.svg)

Learn more about these relationships by reading [Life of a Plan](life_of_a_plan.md).

Or dive in to the engineering specifications:

- [Plan](plan.md)
- [Transaction](transaction.md)
- [Performer](performer.md)
- [Scheduler](scheduler.md)

Collectively, these objects represent what we consider to be a *minimum-viable motion runtime*.

<!--

LGTM:
- appsforartists
- featherless
- markwei

-->
