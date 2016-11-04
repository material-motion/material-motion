---
layout: page
permalink: /starmap/specifications/runtime/
---

# Motion runtime

This section defines a system that emphasizes the separation of a plan from its execution. We call it a *motion runtime*, or **runtime** for short.

A runtime serves two primary purposes:

- Provide an abstraction layer between the application engineer and the performance of motion.
- Coordinate the expression of diverse types of motion and interaction.

The following diagram shows where the runtime lives in relation to a platform like iOS.

![]({{ site.url }}/assets/Abstraction.svg)

## Overview

A runtime will find a way to perform any plans it is provided.

This sentence introduces two important questions:

1. How are plans provided to a runtime?
1. How does a runtime know how to perform plans?

To answer the first question we introduce our first type: `Plan`.

> A plan is an object representing **what you want something to do**.

To answer the second question we introduce two more types: the `Performer` and the `Runtime`.

> A performer's sole responsibility is to fulfill the contract defined by one or more plans. A runtime is the entity that creates performers.

Here's how these objects fit together:

1. Plans are added to a runtime.
2. Runtimes create performers.
3. Performers fulfill the plans.

In visual form:

![]({{ site.url }}/assets/RuntimeOverview.svg)

Learn more about these relationships by reading [Life of a Plan](life_of_a_plan).

Or dive in to the engineering specifications:

- [Plan](plan)
- [Performer](performer)
- [Runtime](runtime)
