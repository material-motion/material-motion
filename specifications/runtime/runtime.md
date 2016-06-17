# Runtime


***Aside: Plan ↔ Executor association***

We'll assume a function exists that returns an Executor capable of fulfilling a type of Plan. The method signature for this method might look like this:

    function ExecutorForPlan(plan, target, existingExecutors) -> Executor

This function could use an `Plan type → Executor type` look-up table. The look-up could be implemented in many ways:

**Plan → Executor**

Plans define the Executor they require. This requires Plans to be aware of their Executors, which is not ideal. It does, however, avoid a class of problems that exist if Executors can define which Plans they fulfill.

**Executor → Plan**

Executors define which Plans they can fulfill. This approach allows Plans to be less intelligent. But it introduces the possibility of Executors conflicting on a given Plan.


---

## Open topics

The following topics are open for discussion. They do not presently have a clear recommendation.

- When should Executors be removed from a Runtime?

