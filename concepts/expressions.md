# Expressions

An Expression is functional syntactic sugar for the creation and configuration of Intentions.

Through the following examples we will explore the essential aspects of an Expression:

1. `expression = Tween()`
2. `expression = Tween().fadeIn()`
3. `expression = Tween().fadeIn().withEasingCurve(easeOut)`
4. `expression = Gesture().pinchable().rotatable().draggable()`
5. `expression.intentions()`

## 1. Languages

    expression = Tween()

Expressions begin with a Language. A Language is an instance of an object.

> Read our [Motion Language recommendations](../languages/).

Languages have **terms**.

For example, the Tween Language definition might look like:

    Tween {
      fn fadeIn(...) -> Term
      fn fadeOut(...) -> Term
      fn moveTo(...) -> Term
      fn rotateBy(...) -> Term
      ...
    }

**Scope**: The purpose of a Language object is to define a lexical scope for a particular set of terms. This allows an ecosystem of Languages to exist where some Languages may have similar or identical terms. The responsibility of any given Language’s creator is to clearly explain what a term will do. This documentation would be ideally represented as a visual interactive dictionary.

**Capitalization**: Language names start with a capital letter. Terms start with a lowercase letter.

## 2. Terms

    expression = Tween().fadeIn()

A **term function** is the entry point for creating Intention. An instance of a Term is returned by a Language’s term function.

The purpose of a Term is to initiate the creation of one or more Intentions. The implementation of the term may create one or more Intentions and initialize well-documented defaults.

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

A modifier class is a type of Language.

**Example modifier definition:**

    TweenTerm {
      fn withEasingCurve(curve) -> Term
      fn withDuration(seconds) -> Term
      ...
    }

**Example modifier method implementation:**

    function TweenModifier.withEasingCurve(curve) -> TweenTerm {
      return TweenTerm(previousTerm: self.previousTerm, work: function() {
        let intentions = self.work()
        for intention in intentions {
          intention.easingCurve = curve
        }
        return intentions
      })
    }

Note the use of the self.chain method. This internal method creates a new immutable TweenTerm instance with a reference to the current instance and the provided function.

The above implementation allows the engineer to **chain** modifications. Expressions can now be stored and extended without affecting previous instances.

    let fadeIn = Tween().fadeIn()
    elementA.addIntentions(fadeIn.intentions())
    elementB.addIntentions(fadeIn.withEasingCurve(easeOut).intentions())

**Immutability**: modifiers are immutable.

**Order**: Modifications must be applied to the term in the order in which they were specified.

**Prefix**: Modifiers begin with a lower-case preposition (e.g. with/to/after).

#### 4. Chaining

    expression = Gesture().pinchable().and.rotatable().and.draggable()

Terms within a Language can be chained together by using the special `and` object. `and` is a function or dynamic property that returns a new instance of the Language object.

In order for the `intentions()` function to resolve a chain of multiple terms, the returned Language object needs to store a reference to the previous term.

    TweenTerm {
      and = function() -> Tween {
        return TweenAndTerm(previousTerm: self)
      }
    }
    
    TweenAndTerm: Tween, Term {
      let previousTerm
      
      intentions = function() -> [Intentions] {
        return self.previousTerm.intentions()
      }
    }


#### 5. Generating intentions

    expression.intentions() -> [Intentions]

Every expression must be resolvable into an array of Intentions.

Successive invocations of this method should generate new Intentions.