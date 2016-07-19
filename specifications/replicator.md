# ReplicaControllerDelegate specification

This is the engineering specification for the `ReplicaControllerDelegate` abstract type.

A instance of a `Replicator` creates similar replicas of visual elements. Replicas do not necessarily need to be as functional as their original element.

Printable tech tree/checklist:

![](../_assets/ReplicatorTechTree.svg)

---

<p style="text-align:center"><tt>MVP</tt></p>

**Abstract type**: `Replicator` is a protocol, if your language has that concept.

Example pseudo-code:

    protocol Replicator {
    }

**createReplica API**: Provide an API for replicating an element.

This API should accept an element and return an element.

Returning the provided element indicates that the element should not be replicated.

Example pseudo-code:

    protocol Replicator {
      function createReplica(Element element) -> Element
    }

<p style="text-align:center"><tt>/MVP</tt></p>

---
