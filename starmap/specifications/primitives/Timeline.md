---
layout: page
title: GestureRecognizer
status:
  date: November 8, 2016
  is: Draft
---

# Timeline specification

This is the engineering specification for the `Timeline` object.

## Overview

## MVP

### Initializer

Pseudo-code example:

```
class Timeline {
  init(duration)
}
```

### Duration API

Expose a read-only duration API.

```
class Timeline {
  let duration: TimeInterval
```

### Progress API

Expose a writeable progress API.

```
class Timeline {
  let progress: Double
```

### Paused API

Expose a writeable paused API.

```
class Timeline {
  let paused: Boolean
```

### Reversed API

Expose a writeable reversed API.

```
class Timeline {
  let reversed: Boolean
```
