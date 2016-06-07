# Material Motion Dictionary

This is a definition of the Terms used by the Material Motion team in their Expressions. All Material Motion Term implementations are expected to adhere to this guide.

This guide is primarily written for engineers.

Terminology used here:

- `<null>`. Platform-dependent. Generally means "the current value of the target's relevant property"

Types used here:

- `float`. Platform-dependent. Generally a floating point number. Example: 3.14159.
- `point`. Platform-dependent. Generally a two- or three-dimensional position in space. Example: {10, 5}

---

Term: `fadeIn()`

Fade the target's opacity in.

Modifiers:

- .from(float) Default: 0
- .to(float)   Default: 1

Required target properties:

- opacity

---

Term: `fadeOut()`

Fade the target's opacity out.

Modifiers:

- .from(float) Default: `1`
- .to(float)   Default: `0`

Required target properties:

- opacity

---

Term: `moveFrom(point)`

Moves the target from the provided position.

Modifiers:

- .from(position) Default: `point`
- .to(position)   Default: `<null>`

Required target properties:

- position

---

Term: `moveTo(point)`

Moves the target to the provided position.

Modifiers:

- .from(position) Default: `<null>`
- .to(position)   Default: `point`

Required target properties:

- position

---

Term: `squashAndStretch()`

The target squashes and stretches in the direction of its movement.

Required target properties:

- position

---
