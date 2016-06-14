Status of this document: **Experimental**

# Motion expression

A **motion expression** is functional, syntactic sugar for the creation and configuration of plans.

## 1. Families

    expression = Tween()

Motion expressions begin with a family. An instance of a Family is created by the user to start a motion expression. A family does not intrinsically define any plans.

The purpose of a Family is to define a lexical scope for a particular set of terms. This allows an ecosystem of families to exist where some families may have similar or identical terms. A family should document what its terms do.

Pseudo-code example implementation of a Tween family:

    Tween: Family {
      fn fadeIn(...) -> Term
      fn fadeOut(...) -> Term
      fn moveTo(...) -> Term
      fn rotateBy(...) -> Term
      ...
    }

> Note: Family names start with a capital letter.

Families have **term functions**. A term function initiates the description of plans.

## 2. Terms

    expression = Tween().fadeIn()
    
A term is the building block of in a motion expression. An instance of a Term is returned by a family’s term function. A term defines and manages a set of related plans.

The purpose of a Term is to create and initialize one or more plans. The implementation of the term may initialize well-documented defaults on the plans.

Pseudo-code example implementation of a fadeIn() term function:

    fn Tween.fadeIn() -> TweenTerm {
      return TweenTerm(previousTerm: self, work: function() {
        let animation = TweenAnimation("opacity")
        animation.from = 0
        animation.to = 1
        return [animation]
      })
    }
    
> Note: Term functions start with a lowercase letter.
> **Terms must be created with functions**. It may be tempting to define argument-less terms as dynamic properties (if your language supports this). This would allow motion expressions like `Tween().fadeIn`. We explicitly discourage this. Ensure that every term is a function in order to provide consistency to the engineer.
    
Terms have **modifier functions**. A modifier function modifies the plans defined in the term.

## 3. Modifiers

    expression = Tween().fadeIn().withEasingCurve(easeOut)

A term may define modifier functions that can be used to configure the plans defined in that term.

**Example modifier definition:**

    TweenTerm {
      fn withEasingCurve(curve) -> Term
      fn withDuration(seconds) -> Term
      ...
    }

**Example modifier method implementation:**

    function TweenModifier.withEasingCurve(curve) -> TweenTerm {
      return TweenTerm(previousTerm: self.previousTerm, work: function() {
        let plans = self.work()
        for plan in plans {
          plan.easingCurve = curve
        }
        return plans
      })
    }

The above implementation allows the engineer to **chain** modifications. Motion expressions can now be stored and extended without affecting previous instances.

    fadeIn = Tween().fadeIn()
    elementA.addPlans(fadeIn.plans())

    fadeInEaseOut = fadeIn.withEasingCurve(easeOut)
    elementB.addPlans(fadeInEaseOut.plans())

**Immutability**: modifiers are immutable.

**Order**: Modifications must be applied to the term in the order in which they were specified.

**Prefix**: Modifiers begin with a lower-case preposition (e.g. with/to/after).

## 4. Chaining terms

    expression = Gesture().pinchable().and.rotatable().and.draggable()

Additional examples:

    draggable = Gesture().draggable()
    target.addPlans(draggable.plans())
    
    # Reusing the draggable expression
    target.addPlans(draggable.and.rotatable().plans())

Terms within a family can be chained together by using the special `and` object. `and` is a function (`and()`) or dynamic property (`and`) that returns a new instance of the family object.

## 5. Generating plans

    plans = expression.plans()

Every motion expression must be resolvable into an array of plans.

Successive invocations of this method should generate new plans.

<!--

LGTM:
- featherless

-->
