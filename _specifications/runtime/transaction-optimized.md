---
layout: page
---

Status of this document:
![](/assets/under-construction-flashing-barracade-animation.gif)

# Transaction optimized feature specification

Open question: Can transactions optimize their operations for over-the-wire transmission?

Known challenges: transactions are ephemeral and lack the long-term context that the runtime posseses. This means we can't necessarily know if a named plan existed before this transaction or not. If we do pursue optimizations here, must take care to respect any existing state of the runtime.

