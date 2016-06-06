# Runtimes

The purpose of a Runtime is to enable the **coordination** of interactive motion in an application. A Runtime applies the Plan/Fulfillment and Coordinator/Plan patterns.

Throughout this chapter we will apply a metaphor oriented around theater terminology. The metaphor primarily consists of **Actors** and **Intentions**.

- An Intention is a **plan**.
- An Actor is expected to **fulfill** Intentions.


A Runtime must be able to do the following, at a minimum:

- Associate Intentions with target objects.
- 

## Intentions and Actors

The Runtime creates Actors and passes a variety of events to them. These events allow Actors to fulfill their Intentions.

![Runtime](../_assets/RuntimeDiagram.png)  
