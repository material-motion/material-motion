# Motion Runtime

The system described here emphasizes a separation of plan from its execution. We call it a Motion Runtime, or Runtime for short.

The purpose of a Runtime is to coordinate the expression of diverse types of motion and interaction. It is an abstraction layer between the application engineer and execution systems.

The following diagram shows where the Runtime lives in relation to a platform like iOS.


![](../../_assets/Abstraction.svg)

## Overview

Let's introduce some new object types: `Plans`, `Transactions`, and `Executors`.

The following diagram shows the relationship of these objects to one another:

![](../../_assets/RuntimeOverview.svg)

Learn more about the [Runtime](runtime.md).

### Plan

Learn more about .

### Executors

Executors are objects created by a Runtime. Executors are expected to translate Plans into execution.

Learn more about [Executors](Executors.md).

### Transactions

Transactions are the mechanism by which Plans are committed to a Runtime.

Learn more about [Transactions](transactions.md).

<!--

LGTM:
- featherless
- markwei

-->
