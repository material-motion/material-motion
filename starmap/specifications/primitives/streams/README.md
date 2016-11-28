---
layout: page
title: Streams
permalink: /starmap/specifications/primitives/streams/
---

# Streams

A light-weight implementation of the Observable pattern designed specifically for use in motion
design. It is based in spirit upon the
[ReactiveX](http://reactivex.io/documentation/observable.html) specification, though we've
intentionally trimmed the operators down to the bare essentials required for motion design.

## MVP expectations

### Generic Observable type

Must provide a single genericized Observable type. This is the starting point for any stream.

### Able to create specific Observable types

It should be possible to create specific Observable types. Common examples:

- Gesture recognizer observable.

### Support the following operators

- filter
- map
