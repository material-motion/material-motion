# Motion Runtime

This section defines a system that emphasizes a separation of plan from its execution. We call it a Motion Runtime, or Runtime for short.

A Runtime serves two primary purposes:

- Provide an abstraction layer between the application engineer and execution systems.
- Coordinate the expression of diverse types of motion and interaction.

The following diagram shows where the Runtime lives in relation to a platform like iOS.


![](../../_assets/Abstraction.svg)

## Overview

Provide some plans to a Runtime and it will find a way to execute them.

This sentence introduces two important questions:

1. How are plans provided to a Runtime?
1. How does a Runtime know how to execute Plans?

To answer the first question we introduce two new types into the system: the Plan and the Transaction.

> A Plan is an object representing **what you want something to do**. A Transaction aggregates requests for Plan-target associations.

To answer the second question we introduce one more type: the Executor.

The following statements define the relationships between each type:

1. Add Plans to Transactions.
2. Commit Transactions to Runtimes.
3. Runtimes create Executors.

In visual form:

![](../../_assets/RuntimeOverview.svg)

Learn more about these relationships by reading [Life of a Plan](life_of_a_plan.md).

Or dive in to the engineering specifications:

- [Runtime](runtime.md).
- [Plan](plan.md).
- [Transaction](transaction.md).
- [Executor](executor.md).

<!--

LGTM:
- featherless
- markwei

-->
