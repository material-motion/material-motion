# ReplicaControllerDelegate specification

This is the engineering specification for the `ReplicaControllerDelegate` abstract type.

## Overview

A instance of a `ReplicaControllerDelegate` creates similar replicas of visual elements. Replicas do not necessarily need to be as functional as their original element.

## MVP

**Abstract type**: `ReplicaControllerDelegate` is a protocol, if your language has that concept.

Example pseudo-code:

    protocol ReplicaControllerDelegate {
    }

**createReplica API**: Provide an API for replicating an element.

This API should accept an element and return an element.

Returning the provided element indicates that the element has not been replicated.

Example pseudo-code:

    protocol ReplicaControllerDelegate {
      function createReplica(Element element) -> Element
    }
