---
layout: page
title: Property names
status:
  date: December 4, 2016
  is: Draft
knowledgelevel: L2
library: streams
depends_on:
  - /starmap/specifications/streams/connections/ReactiveProperty
---

# Property names specification

This is the engineering specification for the names of reactive properties in Material Motion.

## Overview

The following tables correlate the reactive property names on each platform with the terms we use in
the Starmap.

### Names for element properties

| Starmap                        | Android View         | iOS UIView                | CSS                |
|--------------------------------|----------------------|---------------------------|--------------------|
| `backgroundColor`              |                      | `view.backgroundColor`    | `background-color` |
| `width`                        |                      | `view.bounds.width`       | `width`            |
| `height`                       |                      | `view.bounds.height`      | `height`           |
| `cornerRadius`                 |                      | `view.layer.cornerRadius` | `border-radius`    |
| `opacity`                      |                      | `view.alpha`              | `opacity`          |
| `position` relative to parent  | (`view.X`, `view.Y`) | `view.layer.position`     | `translate()`      |
| `positionX` relative to parent | `view.X`             | `view.layer.position.x`   | `translateX()`     |
| `positionY` relative to parent | `view.Y`             | `view.layer.position.y`   | `translateY()`     |
| `rotation`                     |                      |                           | `rotate()`         |
| `scale`                        |                      |                           | `scale()`          |
| `translation`                  |                      |                           |                    |
