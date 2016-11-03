---
layout: page
---

Status of this document:
![]({{ site.url }}/assets/under-construction-flashing-barracade-animation.gif)

# Director composition

TODO: Describe how director composition is intended to work.

Composition of directors:

    TransitionDirector: Director {
      function setUp(transaction) {
        fadeDirector = RadialFadeDirector()
        fadeDirector.setUp(transaction)
        // do other thing
      }
    }

Configuration:

    TransitionDirector: Director {
      function setUp(transaction) {
        fadeDirector = RadialFadeDirector()
        fadeDirector.radius = 500
        fadeDirector.setUp(transaction)
        // do other thing
      }
    }
