---
layout: page
title: Transient views
status:
  date: Oct 25, 2016
  is: Drafting
---

# Condition elements

Condition elements are removed when a condition is met.

---

<p style="text-align:center"><tt>MVP</tt></p>



<p style="text-align:center"><tt>/MVP</tt></p>

---

Can be removed once some function evaluates to true. Many conditions can be built in this way:

- `isOffScreen`
- `timeHasPassed`
- etc...

Function can be scheduled to be checked on any runtime event: update, teardown.

Multiple functions can be registered to a single view.
