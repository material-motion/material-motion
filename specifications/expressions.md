Status of this document: **Stable**

# Motion expression

A **motion expression** is functional syntactic sugar for the creation and configuration of Plans.

New terminology: Language, Term, and modifier.

Through the following examples we will explore the essential aspects of an Expression:

1. `expression = Tween()`
2. `expression = Tween().fadeIn()`
3. `expression = Tween().fadeIn().withEasingCurve(easeOut)`
4. `expression = Gesture().pinchable().rotatable().draggable()`
5. `plans = expression.plans()`
  
## 1. Languages

    expression = Tween()

Motion expressions begin with a Language. A Language is an instance of an object.

> Read our [Motion Language recommendations](../languages/README.md).

Languages have **term functions**. A term function initiates the description of Plans.

**Scope**: The purpose of a Language object is to define a lexical scope for a particular set of terms. This allows an ecosystem of Languages to exist where some Languages may have similar or identical terms. The responsibility of any given Language’s creator is to clearly explain what a term will do. This documentation would be ideally represented as a visual interactive dictionary.

For example, the Tween Language definition might look like:

    Tween {
      fn fadeIn(...) -> Term
      fn fadeOut(...) -> Term
      fn moveTo(...) -> Term
      fn rotateBy(...) -> Term
      ...
    }

**Capitalization**: Language names start with a capital letter. Terms start with a lowercase letter.

## 2. Terms

    expression = Tween().fadeIn()

A **term function** initiates the description of Plans. An instance of a Term is returned by a Language’s term function.

> Note: **Terms must be functions**. It may be tempting to define argument-less terms as dynamic properties. This would allow expressions like `Tween().fadeIn`. We explicitly discourage this. Ensure that every term is a function in order to provide consistency to the engineer.

The purpose of a Term is to initiate the creation of one or more Plans. The implementation of the term may create one or more Plans and initialize well-documented defaults.

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

A term may return an instance of a **modifier** that can be used to further configure the expression.

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

The above implementation allows the engineer to **chain** modifications. Expressions can now be stored and extended without affecting previous instances.

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

Terms within a Language can be chained together by using the special `and` object. `and` is a function (`and()`) or dynamic property (`and`) that returns a new instance of the Language object.

In order for the next term's `plans()` function to resolve a chain of multiple terms, the returned Language object must store a reference to the previous term. One way to do this is to create a sub-type of the Language called an "AndTerm".

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

## 5. Generating Plans

    plans = expression.plans()

Every expression must be resolvable into an array of Plans.

Successive invocations of this method should generate new Plans.

## Follow-up considerations

### Expression helper methods

APIs that accept plans could also accept Expressions. This reduces the need to resolve the expression at the call site.

    target.addExpression(Gesture().draggable())

### Serialization

**Proposal (status: new)**: Expressions should be able to be serialized.

TODO: Discuss value of serializing Expressions vs serializing Plans. Expressions have benefit of not necessarily being entirely platform-specific. As long as a language exists that can implement an Expression then it doesn't matter which Plans are used. If Plans were serialized then we'd be somewhat more implementation-dependant.

    Gesture().draggable().toJSON()

    [
      {
        "language": "Gesture",
        "terms": [
          ["draggable"]
        ]
      }
    ]

    Tween().fadeIn().withDuration(5).toJSON()
    
    [
      {
        "language": "Tween",
        "terms": [
          ["fadeIn", ["withDuration", 5]]
        ]
      }
    ]

Basic JSON structure:

    Expression = [Language]
    Language = {"language": String, "terms": [Term]}
    Term = [String, [Modifier]...]
    Modifier = [String, Arg...]
    Arg = AnyType

### "Style"

**Proposal (status: new)**: How can we "stylize" expressions without having to resort to a brand new Language?

TODO: Provide recommendations for customizing Expressions without having to resort to creating an entirely new Language or subclass of a Language.

Ideas

Encourage functions that accept expressions for the purposes of styling:

    expression = Language().term()
    expression = someStyler(expression)

Discussion

Is more likely that we'll allow clients to stylize Plans than we will allow styling of Expressions/Languages.