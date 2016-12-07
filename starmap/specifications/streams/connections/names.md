---
layout: page
title: Property names
status:
  date: December 4, 2016
  is: Draft
knowledgelevel: L2
library: streams
depends_on:
  - /starmap/specifications/streams/connections/Property
---

# Property names specification

This is the engineering specification for the names of properties in Material Motion.

## Overview

The following tables correlate the property names on each platform with the terms we use in the
Starmap.

### Names for element properties

| Starmap                         | Android View           | iOS UIView  | Web DOM  |
|:--------------------------------|:-----------------------|:------------|:---------|
| `backgroundColor`               |                        |             |          |
| `height`                        |                        |             |          |
| `opacity`                       |                        |             |          |
| `position` relative to parent   | (`view.X`, `view.Y`)   | `view.layer.position` |          |
| `positionX` relative to parent  | `view.X`               | `view.layer.position.x`          |          |
| `positionY` relative to parent  | `view.Y`               | `view.layer.position.y`          |          |
