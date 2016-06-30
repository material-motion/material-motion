# Checklist

This is a list of implementations the Material Motion team plans to work on. Stable implementations will be listed in the [Community Index](https://material-motion.gitbooks.io/material-motion-starmap/content/community_index/).

## Expression Foundation

[Engineering specification](https://material-motion.gitbooks.io/material-motion-starmap/content/specifications/expressions.html).

| Platform | Implementation |
|:--------:|:--------------:|
| Android  | [Experimental work](https://github.com/material-motion/material-motion-expression-android) |
| Objective-C | [Experimental work](https://github.com/material-motion/material-motion-experiments-objc/tree/develop/expressions/ExpressionsCatalog/ExpressionsCatalog) |
| Swift    | Not started |
| Web      | Not started |

## System Tween Expression

Expressions for built-in tween animation types.

[Dictionary](https://material-motion.gitbooks.io/material-motion-starmap/content/material_motion/dictionary.html).

E.g. CoreAnimation().fadeIn()

| Platform | Implementation | Estimated # eng days |
|:--------:|:--------------:|:--------------------:|
| Android  | [Experimental work](https://github.com/material-motion/material-motion-expression-tween-android) | Unknown |
| iOS      | Not started | Unknown |
| Web      | Not started | Unknown |

## Material Motion Runtime

An implementation of the [Runtime](https://material-motion.gitbooks.io/material-motion-starmap/content/specifications/runtime/) concept. The Runtime can be built in stages.

[Engineering specification](https://material-motion.gitbooks.io/material-motion-starmap/content/specifications/runtime/).

### Minimum-viable runtime

Transactions for registering Intentions.

| Platform | Implementation | Estimated # eng days |
|:--------:|:--------------:|:--------------------:|
| Android  | Experimental work | Unknown |
| iOS      | [Experimental work](https://github.com/material-motion/material-motion-experiments-objc/tree/develop/runtime/RuntimeCatalog/RuntimeCatalog) | Unknown |
| Web      | Not started | Unknown |

Performer creation and storage mechanisms.

| Platform | Implementation | Estimated # eng days |
|:--------:|:--------------:|:--------------------:|
| Android  | Experimental work | Unknown |
| iOS      | Not started | Unknown |
| Web      | Not started | Unknown |

Support for Delegated Performers driven by external systems. E.g. Core Animation on iOS.

| Platform | Implementation | Estimated # eng days |
|:--------:|:--------------:|:--------------------:|
| Android  | Experimental work | Unknown |
| iOS      | Not started | Unknown |
| Web      | Not started | Unknown |

### Runtime with custom animations

Performer animation pump event forwarding. Enables custom Intentions like Squishable.

| Platform | Implementation | Estimated # eng days |
|:--------:|:--------------:|:--------------------:|
| Android  | Not started | Unknown |
| iOS      | Not started | Unknown |
| Web      | Not started | Unknown |

### Runtime with gesture handling

Gesture event forwarding. Enables Pinchable, Rotatable, Draggable, etc...

| Platform | Implementation | Estimated # eng days |
|:--------:|:--------------:|:--------------------:|
| Android  | Not started | Unknown |
| iOS      | Not started | Unknown |
| Web      | Not started | Unknown |
