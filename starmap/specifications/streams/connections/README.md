---
layout: page
permalink: /starmap/specifications/streams/connections/
title: Connecting streams with external systems
status:
  date: December 6, 2016
  is: Draft
knowledgelevel: L2
library: streams
depends_on:
  - /starmap/specifications/streams/MotionObservable
---

# Connecting streams with external systems

This is the engineering specification for connecting motion streams with external systems.

## Overview

There are two primary flows of data we care about:

- **Read**: values that are read into a Material Motion stream.
- **Write**: values that are written from a Material Motion stream.

## Connection types

There are two primary ways to read or write a value: **Properties** and **Inline** functions.

|               | Readable connections                                                | Writeable connections                             |
|:--------------|:--------------------------------------------------------------------|:--------------------------------------------------|
| Property type | `$.someOp(initialPositionFrom: propertyOf(view).position)`          | `$.write(to: propertyOf(view).position)`          |
| Property args | `$.someOp(initialPositionFrom: view, property: View.TRANSLATION_X)` | `$.write(to: view, property: View.TRANSLATION_X)` |
| Inline        | `$.someOp({ return view.position })`                                | `$.write({ value in view.position = value })`     |

The above connection types are guidelines around the shape of connections. A given platform must
provide at least one mechanism.
