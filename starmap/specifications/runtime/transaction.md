---
layout: page
---

# Transaction specification

This is the engineering specification for the `Transaction` object.

|  | Android | Apple |
| --- | --- | --- |
| First introduced | [Runtime 1.0.0](https://github.com/material-motion/material-motion-runtime-android/releases) | [Runtime 1.0.0](https://github.com/material-motion/material-motion-runtime-objc/releases/tag/v1.0.0) |

## Features

* [Target enumeration](transaction-enumeration.md)
* [Optimized](transaction-optimized.md)
* [Target selectors](target-selectors.md)
* [Named plans](named-plans.md)
* [Serialization](serialization.md)

## Overview

A transaction aggregates requests for plans to be assigned to targets. Transactions are meant to be committed to a [Runtime](runtime.md). Transactions are **ephemeral**. Transactions should be as "dumb" as possible; a reasonable implementation is no more than a log of requested operations and their parameters.

## MVP

**Simple initializer**: A transaction is cheap to create.

Example pseudo-code:

```
transaction = Transaction()
```

**add API**: Provide an API for a basic add operation.

This API must accept a plan and a target object.

Example pseudo-code:

```
# Associate a plan with a target.
transaction.addPlan(plan, to: target)
```

**commit API**: Provide an API for committing a transaction to a runtime.

Example pseudo-code:

```
transaction.commitToRuntime(runtime)
```

**Operation enumeration**: Operations recorded to a transaction are enumerable.

Operations are enumerated in the order in which they were recorded.

**Copying plans**: When a plan is added to a transaction it must be copied. This ensures that subsequent modifications to a plan object do not affect the transaction. For example:

Example pseudo-code:

```
plan.fromValue = 0
transaction.addPlan(plan, to: target)

plan.fromValue = 5
transaction.addPlan(plan, to: target)
```

Notice that each entry has a different `fromValue` in the following log:

```
[
  {action: 'add', plan: {..., fromValue = 0}}, 
  {action: 'add', plan: {..., fromValue = 5}}
]
```

