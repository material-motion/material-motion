---
layout: page
title: pluck
status:
  date: April 17, 2017
  is: Proposed
interfacelevel: L2
implementationlevel: L3
library: material-motion
depends_on:
  - /starmap/specifications/observable/MotionObservable
  - /starmap/specifications/operators/foundation/$._map
availability:
  - platform:
    name: JavaScript
    url: https://github.com/material-motion/material-motion-js/blob/develop/packages/core/src/operators/pluck.ts
    tests_url: https://github.com/material-motion/material-motion-js/blob/develop/packages/core/src/operators/__tests__/pluck.test.ts
interaction:
  inputs:
    - input:
      name: upstream
      type: T
    - input:
      name: path
      type: String
  outputs:
    - output:
      name: downstream
      type: U
---

# pluck specification

This is the engineering specification for the `MotionObservable` operator: `pluck`.

This operator is reserved for platforms that support keyed type introspection or dictionary-based streams.

## Overview

`pluck` extracts a value from a dictionary using a given path. Paths are dot-delimited keys, e.g. `translate` or `translate.x`.

## Example usage

```javascript
stream.pluck('x')

upstream        path  |  downstream
{x: 50, y: 20}  x     |  50
{x: 10, y:  0}  x     |  10
{x:  5, y: 60}  x     |   5
{x: 60, y: 35}  x     |  60
{x: 53, y: 32}  x     |  53
{x: 21, y: 57}  x     |  21
{x: 57, y: 74}  x     |  57
```

## MVP

### Expose a pluck operator API

Accept a single String argument `path`.

```javascript
pluck<U>(path: string): MotionObservable<U>
```

### Emit the new value

Split the path by `.` and iterate through the incoming dictionary with the resulting array of key values. Emit the final value or nothing if no keyed value exists.

```javascript
const pathSegments = path.split('.');

return function plucker(value: Dict<any>) {
  let result = value;

  for (let pathSegment of pathSegments) {
    result = result[pathSegment];
  }

  return result;
};
```
