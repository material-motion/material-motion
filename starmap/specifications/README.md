---
layout: page
permalink: /starmap/specifications/
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

![]({{ site.url }}/assets/Techstack.svg)

# Library structure

The following diagram details the libraries we intend to create. We use the term library to mean "a collection of objects or types that is as small as possible, but no smaller".

The diagram includes dependencies between each library.

This diagram does not include:

- plan/performer families. E.g. Tween, Gesturing.
- Specific Director implementations. E.g. PhotoDirector, FadeDirector, SlideUpDirector.

![]({{ site.url }}/assets/RepoStructure.svg)
