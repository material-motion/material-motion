---
layout: page
permalink: /starmap/specifications/streams/operators/
---

# Motion operators

## Misc notes

Operators with a `_` prefix can not be represented in a director because they accept functions as
arguments.

Operators with **no** `_` prefix can be represented in a director because they only accept
serializable argument types.

We use `$` to mean "stream" in a variable name. E.g. `pan$` is a pan stream.
