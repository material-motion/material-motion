# ReplicaCreator specification

This is the engineering specification for the `ReplicaCreator` abstract type.

A instance of a `ReplicaCreator` creates similar replicas of visual elements. Replicas do not necessarily need to be as functional as their original element.

Printable tech tree/checklist:

![](../_assets/ReplicaCreatorTechTree.svg)

---

<p style="text-align:center"><tt>MVP</tt></p>

**Abstract type**: `ReplicaCreator` is a protocol, if your language has that concept.

Example pseudo-code:

    protocol ReplicaCreator {
    }

**Duplication API**: Provide an API for duplicating an element.

This API should accept an element and return an element.

Example pseudo-code:

    protocol ReplicaCreator {
      function replicate(Element element) -> Element
    }

<p style="text-align:center"><tt>/MVP</tt></p>

---
