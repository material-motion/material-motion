# Runtimes

The purpose of a Runtime is to enable the **coordination** of interactive motion in an application. A Runtime applies the Plan/Fulfillment and Coordinator/Plan patterns.

Throughout this chapter we will apply a metaphor oriented around theater terminology. The metaphor consists primarily of **Intentions** and **Actors**. Actors fulfill Intention (the plan). Both are objects.

A Runtime object is capable of doing the following:

- Associate Intention instances with target instances.
- Create Actor instances that are able to fulfill the provided Intentions.
- Feed events to Actor instances.
- Delegate events to external systems.

## Associating Intentions

Runtime Intention registration is transactional.

You start a transaction to begin registering Intentions with a Runtime.


![Runtime](../_assets/RuntimeDiagram.png)  

## Creating Actors

## Events

## Delegating events
