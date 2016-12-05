---
layout: page
title: MotionObservable
status:
  date: December 4, 2016
  is: Draft
knowledgelevel: L4
library: streams
depends_on:
  - /starmap/specifications/streams/MotionObservable
---

# OP specification

This is the engineering specification for the `OP` object.

## Overview

Observables can be referred to as operators. A series of operators is referred to a stream. In order
provide introspection capabilities, each operator is expected to store a small amount of meta
information about itself. This information is stored in an object called `OP`.

## MVP

Provide an `OP` type that represents metadata about the operator.