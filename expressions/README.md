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

A **term** function is the entry point for creating Intention. An instance of a Term is returned by a Language’s term function.

The purpose of a term is to initiate the creation of one or more Intentions. The implementation of the term may create one or more Intentions and initialize well-documented defaults.

Pseudo-code example implementation:

    fn Tween.fadeIn() -> TweenTerm {
      return TweenTerm(prev: self, work: function() {
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

    function TweenModifier.withEasingCurve(curve) -> Term {
      return self.chain(function(intentions) {
        for intention in intentions {
          intention.easingCurve = curve
        }
        return intentions
      })
    }

Note the use of the self.chain method. This internal method creates a new immutable Modifier instance with a reference to the current instance and the provided anonymous function. This pattern allows the Language user to **chain** modifications of the same term together without actually executing them. Expressions can then be stored, reused, and combined.

    let fadeIn = Tween().fadeIn()
    elementA.addIntentions(fadeIn.intentions())
    elementB.addIntentions(fadeIn.withEasingCurve(easeOut).intentions())

**Immutability**: modifiers are immutable.

**Order**: Modifications must be applied to the term in the order in which they were specified.

**Prefix**: Modifiers begin with a lower-case preposition (e.g. with/to/after).