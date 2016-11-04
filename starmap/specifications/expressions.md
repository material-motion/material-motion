---
layout: page
title: Expressions
status:
  date: Oct 25, 2016
  is: Inactive
---

# Expressions

A **motion expression** is functional, syntactic sugar for the creation and configuration of plans.

## 1. Expression namespace

    expression = Tween()

Motion expressions begin with a namespace.

The purpose of a **namespace** is to define a lexical scope for a particular set of term functions. This allows an ecosystem of namespaces to exist where some namespaces may have similar or identical term functions. A namespace should document what its term functions do.

Pseudo-code example implementation of a tween namespace:

    Tween: Family {
      fn fadeIn(...) -> Term
      fn fadeOut(...) -> Term
      fn moveTo(...) -> Term
      fn rotateBy(...) -> Term
      ...
    }

**Syntax**: Families start with a capital letter. Families are nouns.

Families have term functions. A term function initiates the description of plans.

## 2. Terms

    expression = Tween().fadeIn()
    
The purpose of a family's **term function** is to create and initialize a set of related plans.

Pseudo-code example implementation of a fade in term function:

    fn Tween.fadeIn() -> TweenTerm {
      return TweenTerm(previousTerm: self.previousTerm, work: function() {
        let animation = TweenAnimation("opacity")
        animation.from = 0
        animation.to = 1
        return [animation]
      })
    }
    
> **Term functions must be created with functions**. It may be tempting to define argument-less term functions as dynamic properties (if your language supports this). This would allow motion expressions like `Tween().fadeIn`. We explicitly discourage this. Ensure that every term function is a function in order to provide consistency to the engineer.

**Syntax**: Term functions start with a lowercase letter. Term functions are verbs. Adjectives should be prepended with an auxiliary verb (e.g. do/be/has) to make a verb phrase.

A term function creates an instance of a term. The term carries the initialized plans.

The purpose of a **term** is to define a lexical scope for a particular set of modifier functions. This allows a term to define modifier functions that are relevant to its plans. A term should document what its modifier functions do.

Pseudo-code example implementation of a tween term:

    TweenTerm : Term {
      fn withEasingCurve(curve) -> TweenTerm
      fn withDuration(seconds) -> TweenTerm
      ...
    }
    
**Syntax**: Terms start with a capital letter. Terms functions are nouns.
    
Terms have modifier functions. A modifier function modifies the plans in the term.

## 3. Modifiers

    expression = Tween().fadeIn().withEasingCurve(easeOut)

The purpose of a Term's **modifier function** is to configure the plans in that term.

Pseudo-code example implementation of an easing curve modifier function:

    fn TweenTerm.withEasingCurve(curve) -> TweenTerm { {
      return TweenTerm(previousTerm: self.previousTerm, work: function() {
        let plans = self.work()
        for plan in plans {
          plan.easingCurve = curve
        }
        return plans
      })
    }
    
> **Modifier functions must return a new instance of the term**. It may be tempting to directly modify the plans in the term and return `self`. This is not allowed and will break immutability.

**Syntax**: Modifier functions start with a lowercase letter. Modifier functions begin with a preposition (e.g. with/to/after).

## 4. Chaining

    expression = Gesture().rotatable().withMaxDelta(45).and.draggable()

A motion expression is **immutable**, which allows the engineer to **chain** terms and modifications. Motion expressions can be stored and extended without affecting previous instances.

**Term chaining**: Terms within a family can be chained together by using the special `and` object.

    draggable = Gesture().draggable()
    target.addPlans(draggable.plans())
    
    # Reusing the draggable expression
    target.addPlans(draggable.and.rotatable().plans())

> Note: `and` is a new instance of the family object. `and` can be a dynamic property (if your language supports this) or a read-only field.

**Modifier chaining**: Modifiers within a term can be chained together. Modifications must be applied to the term in the order in which they were specified.

    fadeIn = Tween().fadeIn().withEasingCurve(easeIn)
    elementA.addPlans(fadeIn.plans())

    # Reusing the fadeIn expression
    elementB.addPlans(fadeIn.withEasingCurve(easeOut).from(.5f).plans())

## 5. Generating plans

    plans = expression.plans()

Every motion expression must be resolvable into an array of plans.

Successive invocations of this method should generate new plans.
