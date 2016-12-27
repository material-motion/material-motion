---
layout: page
---

# Writing specs

Engineering specifications are the means by which we discuss and ratify what we'd like to build
across all of our supported platforms. All specs have a consistent shape and are expected to evolve
over time.

## General guidelines

**Purpose**: To provide a checklist for an engineer to validate their implementation against.

**Shape**: Specs start with an **overview** of the topic and then a broken-down
**minimum-viable product (MVP) specification**. Each part of the MVP specification should be as
small as possible, and no smaller.

**Order of information**: The spec should be readable in a top-down fashion.

**Audience**: The audience is expected to be highly technical, with a strong understanding of types,
object oriented programming, and functional programming.

**Build it first**: If you are writing a spec you ideally already have a working implementation in
your language of choice. Do not paste this implementation into the spec verbatim. Your role as spec
writer is to break the implementation apart into a checklist. Another engineer - potentially
thinking in a language different from your own - can then follow this checklist.

**Language-agnostic**: Avoid use of language-specific features where possible. If a
language-specific feature is necessary, explain why. Examples of language-specific features include:

- Function short-hand (`() => ()` in JavaScript, `$0` notation in swift).
- Named arguments (Objective-C and swift).
- Protocol extensions (swift).

Features we expect to be available in all of our supported languages:

- Compile-time type enforcement.
- Generics.
- Objects.

**Conformance**: Specs do not need to be 100% byte-for-byte accurate. The goal is to communicate the
intent and shape of the topic, not its literal implementation.

**Features**: Identify non-MVP features and break them apart into separate
**feature specifications**. A feature specification can build off of an MVP in a parallel fashion.

## Shape of a spec

Presented below is the outline of an engineering specification. We discuss each section in more
detail further below.

```yaml
---
key: value
key: value
...
---

# <topic> specification

This is the engineering specification for the `<topic>` API.

## Overview

A high-level overview of the topic. Discuss new concepts where relevant.

## Examples

An optional set of examples showing use of the topic.

## MVP

### Specific thing to build

And how to build it.
```

## YAML preamble

All specs start with a yaml preamble. This preamble includes relevant metadata.

### Layout

```yaml
layout: page
```

### Status

Indicates the current status of the page.

Date must be long-form `Month day, year` format.

Status can be any of `Draft`, `Experimental`, or `Stable`.

```yaml
status:
  date: December 13, 2016
  is: Draft
```

### Knowledge level

Defines the expected end-user knowledge level for this topic.

There are four knowledge levels: L1-L4.

```yaml
knowledgelevel: L2
```

### Library

The library this API should live within.

All library names are lower-cased and hyphenated.

```yaml
library: streams
```
### Dependencies

A list of absolute paths to other starmap files.

A dependency is a spec that must be built before this spec can be built.

```yaml
depends_on:
  - /starmap/specifications/primitives/gesture_recognizers/GestureRecognizer
  - /starmap/specifications/streams/operators/foundation/$._map
```

### Stream type

Operators should define their expected input and output types.

```yaml
streamtype:
  in: GestureRecognizer
  out: Point
```

### Availability

Link to the platform's source and tests, when available.

We use the following platform names: `Android`, `iOS`, and `JavaScript`.

```yaml
availability:
  - platform:
    name: <platform name>
    url: <source url>
    tests_url: <tests url>
  - platform:
    name: <platform name>
    url: <source url>
    tests_url: <tests url>
```
