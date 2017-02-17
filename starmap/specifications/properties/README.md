---
layout: page
permalink: /starmap/specifications/properties/
title: Connecting streams with external systems
status:
  date: December 6, 2016
  is: Draft
knowledgelevel: L2
library: reactive-motion
---

# Connecting streams with external systems

This is the engineering specification for connecting motion streams with external systems.

## Overview

There are two primary flows of data we care about:

- **Read**: values that are read into a Material Motion stream.
- **Write**: values that are written from a Material Motion stream.

## Connection types

There are two primary ways to read or write a value: **Scoped** and **Unscoped**.

| Option Number | Name                   | Readable connections             | Writable connections                  |
|:--------------|:-----------------------|:---------------------------------|:---------------------------------------|
| 1.            | Scoped Property        | `propertyOf(view).positionX`     | `propertyOf(view).positionX`           |
| 2.            | Unscoped Property      | `source: view, property: View.X` | `target: view, property: View.X`       |
| 1. variant    | Inline scoped property | `{ return view.position.x }`     | `{ value in view.position.x = value }` |

The above connection types are guidelines around the shape of connections. A given platform must
provide at least one mechanism but likely won't need to provide both. Pick the one that makes the
most sense for your platform and build the stack with that first.

A **Scoped Property** is a property instance that writes to a *specific* target.

An **Unscoped Property** is a property instance that can write to *any* target.
