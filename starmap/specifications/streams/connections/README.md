---
layout: page
permalink: /starmap/specifications/streams/connections/
title: Connecting with external systems
status:
  date: December 6, 2016
  is: Draft
knowledgelevel: L3
library: streams
---

# Connecting with external systems

This is the engineering specification for connecting Material Motion streams with external systems.

## Overview

There are two primary flows of data we care about:

- **Read**: values that are read into a Material Motion stream.
- **Write**: values that are written from a Material Motion stream.

## Mechanisms

There are two primary ways to read or write a value: **Properties** and **Inline** functions.

|               | Read                                                              | Write                                            |
|:--------------|:------------------------------------------------------------------|:-------------------------------------------------|
| Property type | `$.someOp(initialValue: propertyOf(view).position)`               | `$.write(to: propertyOf(view).position)`         |
| Property args | `$.someOp(initialValue: View.TRANSLATION_X, from: view)`          | `$.write(View.TRANSLATION_X, to: view)`          |
| Inline        | `$.someOp({ return view.position })`                              | `$.write({ value in view.position = value })`    |

The above mechanisms are guidelines around the shape of referring to properties. A given platform
must provide at least one mechanism.
