# Expressions

An Expression is functional syntactic sugar for the creation and configuration of Intentions.

Through the following examples we will explore the essential aspects of an Expression:

1. `expression = Tween()`
2. `expression = Tween().fadeIn()`
3. `expression = Tween().fadeIn().withEasingCurve(easeOut)`
4. `expression = Gesture().pinchable().rotatable().draggable()`
5. `expression.intentions()`

## 1. Languages

```expression = Tween()```

Expressions begin with a Language. A Language is an instance of an object.

Languages have **terms**.

For example, the Tween Language definition might look like:

```
Tween {
  fn fadeIn(...) -> Term
  fn fadeOut(...) -> Term
  fn moveTo(...) -> Term
  fn rotateBy(...) -> Term
  ...
}
```

**Scope**: The purpose of a Language object is to define a lexical scope for a particular set of terms. This allows an ecosystem of Languages to exist where some Languages may have similar or identical terms. The responsibility of any given Language’s creator is to clearly explain what a term will do. This documentation would be ideally represented as a visual interactive dictionary.

**Capitalization**: Language names start with a capital letter. Terms start with a lowercase letter.

