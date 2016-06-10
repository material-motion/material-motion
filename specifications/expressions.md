Status of this document: **Stable**

# Motion expression

A **motion expression** is functional syntactic sugar for the creation and configuration of plans.

Through the following examples we will explore the essential aspects of a motion expression:

1. `expression = Tween()`
2. `expression = Tween().fadeIn()`
3. `expression = Tween().fadeIn().withEasingCurve(easeOut)`
4. `expression = Gesture().pinchable().rotatable().draggable()`
5. `plans = expression.plans()`
  
## 1. Families

    expression = Tween()

Motion expressions begin with a family. A family is an instance of an object.

> Read our [Motion Language recommendations](../languages/README.md).

Families have **term functions**. A term function initiates the description of plans.

**Scope**: The purpose of a family object is to define a lexical scope for a particular set of terms. This allows an ecosystem of Families to exist where some Families may have similar or identical terms. The responsibility of any given family’s creator is to clearly explain what a term will do. This documentation would be ideally represented as a visual interactive dictionary.

For example, the tween family definition might look like:

    Tween {
      fn fadeIn(...) -> Term
      fn fadeOut(...) -> Term
      fn moveTo(...) -> Term
      fn rotateBy(...) -> Term
      ...
    }

**Capitalization**: Family names start with a capital letter. Terms start with a lowercase letter.

## 2. Terms

    expression = Tween().fadeIn()

A **term function** initiates the description of plans. An instance of a Term is returned by a family’s term function.

> Note: **Terms must be functions**. It may be tempting to define argument-less terms as dynamic properties. This would allow motion expressions like `Tween().fadeIn`. We explicitly discourage this. Ensure that every term is a function in order to provide consistency to the engineer.

The purpose of a Term is to initiate the creation of one or more plans. The implementation of the term may create one or more plans and initialize well-documented defaults.

Pseudo-code example implementation:

    fn Tween.fadeIn() -> TweenTerm {
      return TweenTerm(previousTerm: self, work: function() {
        let animation = TweenAnimation("opacity")
        animation.from = 0
        animation.to = 1
        return [animation]
      })
    }

## 3. Modifiers

    expression = Tween().fadeIn().withEasingCurve(easeOut)

A term may return an instance of a **modifier** that can be used to further configure the motion expression.

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

In order for the next term's `plans()` function to resolve a chain of multiple terms, the returned family object must store a reference to the previous term. One way to do this is to create a sub-type of the family called an "AndTerm".

    TweenTerm {
      and = function() -> Tween {
        return TweenAndTerm(previousTerm: self)
      }
    }
    
    TweenAndTerm: Tween, Term {
      let previousTerm
      
      plans = function() -> [Plans] {
        return self.previousTerm.plans()
      }
    }

## 5. Generating plans

    plans = expression.plans()

Every motion expression must be resolvable into an array of plans.

Successive invocations of this method should generate new plans.

## Follow-up considerations

### Motion expression helper methods

APIs that accept plans could also accept motion expressions. This reduces the need to resolve the motion expression at the call site.

    target.addMotion(Gesture().draggable())

### Serialization

**Proposal (status: new)**: Motion expressions should be able to be serialized.

TODO: Discuss value of serializing motion expressions vs serializing plans. Motion expressions have benefit of not necessarily being entirely platform-specific. As long as a language exists that can implement an motion expression then it doesn't matter which plans are used. If plans were serialized then we'd be somewhat more implementation-dependant.

    Gesture().draggable().toJSON()

    [
      {
        "family": "Gesture",
        "terms": [
          ["draggable"]
        ]
      }
    ]

    Tween().fadeIn().withDuration(5).toJSON()
    
    [
      {
        "family": "Tween",
        "terms": [
          ["fadeIn", ["withDuration", 5]]
        ]
      }
    ]

Basic JSON structure:

    Expression = [Family]
    Family = {"family": String, "terms": [Term]}
    Term = [String, [Modifier]...]
    Modifier = [String, Arg...]
    Arg = AnyType

### "Style"

**Proposal (status: new)**: How can we "stylize" motion expressions without having to resort to a brand new family?

TODO: Provide recommendations for customizing motion expressions without having to resort to creating an entirely new family or subclass of a family.

Ideas

Encourage functions that accept motion expressions for the purposes of styling:

    expression = Family().term()
    expression = someStyler(expression)

Discussion

Is more likely that we'll allow clients to stylize plans than we will allow styling of motion expressions/Families.

<!--

LGTM:
- featherless

-->
