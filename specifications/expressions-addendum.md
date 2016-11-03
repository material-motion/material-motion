---
layout: page
---

# Expressions

## Follow-up considerations

### Motion expression helper methods

APIs that accept plans could also accept motion expressions. This reduces the need to resolve the motion expression at the call site.

    target.addMotion(Gesture().draggable())

### Serialization

**Proposal (status: new)**: Motion expressions should be serializable.

TODO: Discuss value of serializing motion expressions vs serializing plans. Motion expressions have benefit of not necessarily being entirely platform-specific. As long as a language exists that can implement an motion expression then it doesn't matter which plans are used. If plans were serialized then we'd be somewhat more implementation-dependent.

    Gesture().draggable().toJSON()

    [
      {
        "family": "material-motion-gestures",
        "terms": [
          ["draggable"]
        ]
      }
    ]

    Tween().fadeIn().withDuration(5).toJSON()
    
    [
      {
        "family": "material-motion-tweens",
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

Is more likely that we'll allow clients to stylize plans than we will allow styling of motion expressions/families.
