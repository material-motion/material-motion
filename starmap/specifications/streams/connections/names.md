---
layout: page
title: Property names
status:
  date: December 4, 2016
  is: Draft
knowledgelevel: L2
library: streams
depends_on:
  - /starmap/specifications/streams/connections/
---

# Property names specification

This is the engineering specification for the names of properties in Material Motion.

## Overview

In order to provide a consistent set of getters and setters across all platforms we've provided the
following list of preferred names.

We list properties for a variety of object types below. The Starmap column defines the term we use
throughout the Starmap. We also provide a column for each platform that maps to the
platform-specific property in case it deviates from the Starmap name.

### Names for element properties

| Starmap                         | Android                | iOS       | Web      |
|:--------------------------------|:-----------------------|:----------|:---------|
| `backgroundColor`               |                        |           |          |
| `height`                        |                        |           |          |
| `opacity`                       |                        |           |          |
| `position` relative to parent   | (`View.X`, `View.Y`)   |           |          |
| `positionX` relative to parent  | `View.X`               |           |          |
| `positionY` relative to parent  | `View.Y`               |           |          |
