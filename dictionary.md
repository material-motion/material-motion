# Motion Dictionary

This is a definition of the Terms used by the Material Motion team in their Expressions.

---

Term: fadeIn()

Fade the target's opacity in.

Modifiers:

- .from(float) Default: 0
- .to(float)   Default: 1

Required target properties:

- opacity

---

Term: fadeOut()

Fade the target's opacity out.

Modifiers:

- .from(float) Default: 1
- .to(float)   Default: 0

Required target properties:

- opacity

---

Term: moveFrom(point)

Moves the target from the provided position.

Modifiers:

- .from(position) Default: point
- .to(position)   Default: <null>

---

Term: moveTo(point)

Moves the target to the provided position.

Modifiers:

- .from(position) Default: <null>
- .to(position)   Default: point

---

Term: squashAndStretch()

The target squashes and stretches in the direction of its movement.

Required target properties:

- position

---
