---
layout: page
permalink: /specifications/
title: Engineering spec
---

# Engineering spec

This section of the book defines engineering specifications and concepts.

The tone is meant to be both **aspirational** and **educational**.

The audience is software engineers interested in building motion and interaction systems.

Throughout this chapter we write statements as simple facts. All are open for debate and conversation.

Much of what we'll describe is not new. Some things we'll discuss have existed for decades. Where applicable, we've included links to both ours and others' work in the field.

Within the best of our ability the provided specifications are platform and language-agnostic. We assume that you're working with an object-oriented language. We're inspired by functional programming but apply a pragmatic approach to system design.

# Tech stack

The following chart is the tech stack for Material Motion. Lower items in the chart must be built before higher order items can be built.

Each platform has its own implementation of this tech stack.

Tech is grouped into **focus areas**. Each focus area is represented by a colored region in the diagram.

![](/assets/Techstack.svg)

# Education groups

We categorize the education of Material Motion into the following groups:

1. App creator
2. Director creator
3. Motion creator
4. Runtime engineering

Each group in the list above requires more knowledge of the Material Motion ecosystem than the group preceding it.

## Knowledge expectations

**App creator**: knows how to use and compose Directors.

**Director creator**: also knows how to create Directors and use Plans.

**Motion creator**: also knows how to create Plans/Performers.

**Runtime engineer**: also knows how to modify the runtime.

Creators should rarely, if ever, have to acquire an understanding of runtime engineering.

The Starmap is written for the runtime engineering group.

## Methods of positioning these expectations

Provide two categories of educational material: **using** material motion and **extending** material motion.

Using material motion will target app creators.

Extending material motion will target director/motion creators.

## Knowledge iceberg

The following diagram shows the required amount of knowledge for each group.

![](/assets/Roles.svg)

# The design/engineering handoff

One hopeful outcome of the Material Motion project is to remove the design/engineering "hand off". By encouring both designers and engineers to think of motion in a common language, we hope to see the line blur between what is motion design and what is engineering.

**Guaranteed near future**: not far from the status quo.

![](/assets/Handoff-v1.svg)

**The ideal future**: design/engineering working in tandem to create interactive, production-ready experiences.

![](/assets/Handoff-v2.svg)


# Library structure

The following diagram details the libraries we intend to create. We use the term library to mean "a collection of objects or types that is as small as possible, but no smaller".

The diagram includes dependencies between each library.

This diagram does not include:

- plan/performer families. E.g. Tween, Gesturing.
- Specific Director implementations. E.g. PhotoDirector, FadeDirector, SlideUpDirector.

![](/assets/RepoStructure.svg)
