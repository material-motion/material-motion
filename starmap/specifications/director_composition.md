---
layout: page
title: Director composition
status:
  date: Oct 25, 2016
  is: Drafting
---

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
