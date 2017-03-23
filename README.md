---
layout: default
permalink: /
---

# Material Motion

Welcome to the Material Motion documentation site. Please check out the [Starmap](starmap/) for our engineering specification and our [Team](team/) documentation to learn more about our culture.

Current status: **early development**.

[Chat with us on Discord](https://discord.gg/ZJyGXza).

This library includes a variety of ready-to-use **interactions**. Interactions are registered to an
instance of `MotionRuntime`:

```swift
// Store me for as long as the interactions should take effect.
let runtime = MotionRuntime(containerView: <#view#>)
```

<table>
  <thead><tr><th></th><th>Interaction</th><th>Snippet</th></tr></thead>
  <tbody>
    <tr>
      <td align="center"><img style="max-width: 128px" src="assets/arcmove.gif" /></td>
      <td><pre><code class="language-swift">ArcMove</code></pre></td>
      <td><pre><code class="language-swift">let arcMove = ArcMove()
arcMove.from.value = <#from#>
arcMove.to.value = <#to#>
runtime.add(arcMove, to: <#view#>)</code></pre></td>
    </tr>
    <tr>
      <td align="center"><img style="max-width: 128px" src="assets/directlymanipulable.gif" /></td>
      <td><pre><code class="language-swift">DirectlyManipulable</code></pre></td>
      <td><pre><code class="language-swift">runtime.add(DirectlyManipulable(), to: <#view#>)</code></pre></td>
    </tr>
    <tr>
      <td align="center"><img style="max-width: 128px" src="assets/draggable.gif" /></td>
      <td><pre><code class="language-swift">Draggable</code></pre></td>
      <td><pre><code class="language-swift">runtime.add(Draggable(), to: <#view#>)</code></pre></td>
    </tr>
    <tr>
      <td align="center"><img style="max-width: 128px" src="assets/rotatable.gif" /></td>
      <td><pre><code class="language-swift">Rotatable</code></pre></td>
      <td><pre><code class="language-swift">runtime.add(Rotatable(), to: <#view#>)</code></pre></td>
    </tr>
    <tr>
      <td align="center"><img style="max-width: 128px" src="assets/scalable.gif" /></td>
      <td><pre><code class="language-swift">Scalable</code></pre></td>
      <td><pre><code class="language-swift">runtime.add(Scalable(), to: <#view#>)</code></pre></td>
    </tr>
    <tr>
      <td align="center"><img style="max-width: 128px" src="assets/setpositionontap.gif" /></td>
      <td><pre><code class="language-swift">SetPositionOnTap</code></pre></td>
      <td><pre><code class="language-swift">runtime.add(SetPositionOnTap(),
            to: runtime.get(<#view#>.layer).position)</code></pre></td>
    </tr>
    <tr>
      <td align="center"><img style="max-width: 128px" src="assets/spring.gif" /></td>
      <td><pre><code class="language-swift">Spring</code></pre></td>
      <td><pre><code class="language-swift">let spring = Spring()
spring.destination.value = <#initial destination#>
runtime.add(spring, to: <#view#>)</code></pre></td>
    </tr>
    <tr>
      <td align="center"><img style="max-width: 128px" src="assets/tossable.gif" /></td>
      <td><pre><code class="language-swift">Tossable</code></pre></td>
      <td><pre><code class="language-swift">let tossable = Tossable()
tossable.spring.destination.value = <#initial destination#>
runtime.add(tossable, to: <#view#>)</code></pre></td>
    </tr>
    <tr>
      <td align="center"><img style="max-width: 128px" src="assets/tween.gif" /></td>
      <td><pre><code class="language-swift">Tween</code></pre></td>
      <td><pre><code class="language-swift">runtime.add(Tween(duration: 0.5, values: [1, 0]),
            to: runtime.get(<#view#>.layer).opacity)</code></pre></td>
    </tr>
  </tbody>
</table>

## Installation

### Installation with CocoaPods

> CocoaPods is a dependency manager for Objective-C and Swift libraries. CocoaPods automates the
> process of using third-party libraries in your projects. See
> [the Getting Started guide](https://guides.cocoapods.org/using/getting-started.html) for more
> information. You can install it with the following command:
>
>     gem install cocoapods

Add `MaterialMotion` to your `Podfile`:

    pod 'MaterialMotion'

Then run the following command:

    pod install

### Usage

Import the framework:

    import MaterialMotion

You will now have access to all of the APIs.

## Example apps/unit tests

Check out a local copy of the repo to access the Catalog application by running the following
commands:

    git clone https://github.com/material-motion/material-motion-swift.git
    cd material-motion-swift
    pod install
    open MaterialMotion.xcworkspace

## Case studies

### Carousel

<img src="assets/carousel.gif" />

A carousel with pages that scale in and fade out in reaction to their scroll position.

[View the source](examples/CarouselExample.swift).

### Contextual transition

<img src="assets/contextualtransition.gif" />

A contextual view can be used to create continuity during transitions between view controllers. In
this case study the selected photo is the contextual view. It's  possible to flick the view to
dismiss it using the tossable interaction.

Makes use of: `Draggable`, `Tossable`, `Transition`, `TransitionSpring`, `Tween`.

[View the source](examples/ContextualTransitionExample.swift).

### Floating action button transition

<img src="assets/fabtransition.gif" />

A floating action button transition is a type of contextual transition that animates a mask outward
from a floating button.

Makes use of: `Transition` and `Tween`.

[View the source](examples/FabTransitionExample.swift).

### Material expansion

<img src="assets/materialexpansion.gif" />

A Material Design transition using assymetric transformations.

Makes use of: `Tween`.

[View the source](examples/MaterialExpansionExample.swift).

### Modal dialog

<img src="assets/modaldialog.gif" />

A modal dialog that's presented over the existing context and is dismissable using gestures.

Makes use of: `Tossable` and `TransitionSpring`.

[View the source](examples/ModalDialogExample.swift).

### Sticker picker

<img src="assets/stickerpicker.gif" />

Each sticker is individually **directly manipulable**, meaning they can be dragged, rotated, and
scaled using multitouch gestures.

Makes use of: `DirectlyManipulable`.

[View the source](examples/StickerPickerExample.swift).

## Contributing

We welcome contributions!

Check out our [upcoming milestones](https://github.com/material-motion/material-motion-swift/milestones).

Learn more about [our team](https://material-motion.github.io/material-motion/team/),
[our community](https://material-motion.github.io/material-motion/team/community/), and
our [contributor essentials](https://material-motion.github.io/material-motion/team/essentials/).

## License

Licensed under the Apache 2.0 license. See LICENSE for details.

## Android platform support

| Library | Build status | Coverage | Version | Docs | Issues |
|---------|:------------:|:--------:|:-------:|:----:|:------:|
| [conventions-android](https://github.com/material-motion/conventions-android/) | [![Build Status](https://img.shields.io/travis/material-motion/conventions-android/develop.svg)](https://travis-ci.org/material-motion/conventions-android/) | [![codecov](https://img.shields.io/codecov/c/github/material-motion/conventions-android/develop.svg)](https://codecov.io/gh/material-motion/conventions-android/) | [![Release](https://img.shields.io/github/release/material-motion/conventions-android.svg)](https://github.com/material-motion/conventions-android/releases/latest/) | [![Docs](https://img.shields.io/badge/jitpack-docs-green.svg)](null) | [![Open issues](https://img.shields.io/github/issues/material-motion/conventions-android.svg)](https://github.com/material-motion/conventions-android/issues/) |
| [gestures-android](https://github.com/material-motion/gestures-android/) | [![Build Status](https://img.shields.io/travis/material-motion/gestures-android/develop.svg)](https://travis-ci.org/material-motion/gestures-android/) | [![codecov](https://img.shields.io/codecov/c/github/material-motion/gestures-android/develop.svg)](https://codecov.io/gh/material-motion/gestures-android/) | [![Release](https://img.shields.io/github/release/material-motion/gestures-android.svg)](https://github.com/material-motion/gestures-android/releases/latest/) | [![Docs](https://img.shields.io/badge/jitpack-docs-green.svg)]() | [![Open issues](https://img.shields.io/github/issues/material-motion/gestures-android.svg)](https://github.com/material-motion/gestures-android/issues/) |
| [indefinite-observable-android](https://github.com/material-motion/indefinite-observable-android/) | [![Build Status](https://img.shields.io/travis/material-motion/indefinite-observable-android/develop.svg)](https://travis-ci.org/material-motion/indefinite-observable-android/) | [![codecov](https://img.shields.io/codecov/c/github/material-motion/indefinite-observable-android/develop.svg)](https://codecov.io/gh/material-motion/indefinite-observable-android/) | [![Release](https://img.shields.io/github/release/material-motion/indefinite-observable-android.svg)](https://github.com/material-motion/indefinite-observable-android/releases/latest/) | [![Docs](https://img.shields.io/badge/jitpack-docs-green.svg)]() | [![Open issues](https://img.shields.io/github/issues/material-motion/indefinite-observable-android.svg)](https://github.com/material-motion/indefinite-observable-android/issues/) |
| [physics-android](https://github.com/material-motion/physics-android/) | [![Build Status](https://img.shields.io/travis/material-motion/physics-android/develop.svg)](https://travis-ci.org/material-motion/physics-android/) | [![codecov](https://img.shields.io/codecov/c/github/material-motion/physics-android/develop.svg)](https://codecov.io/gh/material-motion/physics-android/) | [![Release](https://img.shields.io/github/release/material-motion/physics-android.svg)](https://github.com/material-motion/physics-android/releases/latest/) | [![Docs](https://img.shields.io/badge/jitpack-docs-green.svg)]() | [![Open issues](https://img.shields.io/github/issues/material-motion/physics-android.svg)](https://github.com/material-motion/physics-android/issues/) |
| [reactive-motion-android](https://github.com/material-motion/reactive-motion-android/) | [![Build Status](https://img.shields.io/travis/material-motion/reactive-motion-android/develop.svg)](https://travis-ci.org/material-motion/reactive-motion-android/) | [![codecov](https://img.shields.io/codecov/c/github/material-motion/reactive-motion-android/develop.svg)](https://codecov.io/gh/material-motion/reactive-motion-android/) | [![Release](https://img.shields.io/github/release/material-motion/reactive-motion-android.svg)](https://github.com/material-motion/reactive-motion-android/releases/latest/) | [![Docs](https://img.shields.io/badge/jitpack-docs-green.svg)]() | [![Open issues](https://img.shields.io/github/issues/material-motion/reactive-motion-android.svg)](https://github.com/material-motion/reactive-motion-android/issues/) |
| [reactive-motion-rebound-android](https://github.com/material-motion/reactive-motion-rebound-android/) | [![Build Status](https://img.shields.io/travis/material-motion/reactive-motion-rebound-android/develop.svg)](https://travis-ci.org/material-motion/reactive-motion-rebound-android/) | [![codecov](https://img.shields.io/codecov/c/github/material-motion/reactive-motion-rebound-android/develop.svg)](https://codecov.io/gh/material-motion/reactive-motion-rebound-android/) | [![Release](https://img.shields.io/github/release/material-motion/reactive-motion-rebound-android.svg)](https://github.com/material-motion/reactive-motion-rebound-android/releases/latest/) | [![Docs](https://img.shields.io/badge/jitpack-docs-green.svg)]() | [![Open issues](https://img.shields.io/github/issues/material-motion/reactive-motion-rebound-android.svg)](https://github.com/material-motion/reactive-motion-rebound-android/issues/) |

## Apple platform support

| Library | Build status | Coverage | Version | Platforms | Docs | Issues |
|---------|:------------:|:--------:|:-------:|:---------:|:----:|:------:|
| [catalog-swift](https://github.com/material-motion/catalog-swift) | [![Build Status](https://img.shields.io/travis/material-motion/catalog-swift/develop.svg)](https://travis-ci.org/material-motion/catalog-swift/) | [![codecov](https://img.shields.io/codecov/c/github/material-motion/catalog-swift/develop.svg)](https://codecov.io/gh/material-motion/catalog-swift/) | [![CocoaPods Compatible](https://img.shields.io/cocoapods/v/.svg)](https://cocoapods.org/pods//) | [![Platform](https://img.shields.io/cocoapods/p/.svg)](http://cocoadocs.org/docsets/) | [![Docs](https://img.shields.io/cocoapods/metrics/doc-percent/.svg)]() | [![Open issues](https://img.shields.io/github/issues/material-motion/catalog-swift.svg)](https://github.com/material-motion/catalog-swift/issues/) |
| [conventions-objc](https://github.com/material-motion/conventions-objc) | [![Build Status](https://img.shields.io/travis/material-motion/conventions-objc/develop.svg)](https://travis-ci.org/material-motion/conventions-objc/) | [![codecov](https://img.shields.io/codecov/c/github/material-motion/conventions-objc/develop.svg)](https://codecov.io/gh/material-motion/conventions-objc/) | [![CocoaPods Compatible](https://img.shields.io/cocoapods/v/.svg)](https://cocoapods.org/pods//) | [![Platform](https://img.shields.io/cocoapods/p/.svg)](http://cocoadocs.org/docsets/) | [![Docs](https://img.shields.io/cocoapods/metrics/doc-percent/.svg)]() | [![Open issues](https://img.shields.io/github/issues/material-motion/conventions-objc.svg)](https://github.com/material-motion/conventions-objc/issues/) |
| [indefinite-observable-swift](https://github.com/material-motion/indefinite-observable-swift) | [![Build Status](https://img.shields.io/travis/material-motion/indefinite-observable-swift/develop.svg)](https://travis-ci.org/material-motion/indefinite-observable-swift/) | [![codecov](https://img.shields.io/codecov/c/github/material-motion/indefinite-observable-swift/develop.svg)](https://codecov.io/gh/material-motion/indefinite-observable-swift/) | [![CocoaPods Compatible](https://img.shields.io/cocoapods/v/IndefiniteObservable.svg)](https://cocoapods.org/pods/IndefiniteObservable/) | [![Platform](https://img.shields.io/cocoapods/p/IndefiniteObservable.svg)](http://cocoadocs.org/docsets/IndefiniteObservable) | [![Docs](https://img.shields.io/cocoapods/metrics/doc-percent/IndefiniteObservable.svg)](http://cocoadocs.org/docsets/IndefiniteObservable/) | [![Open issues](https://img.shields.io/github/issues/material-motion/indefinite-observable-swift.svg)](https://github.com/material-motion/indefinite-observable-swift/issues/) |
| [material-motion-pop-swift](https://github.com/material-motion/material-motion-pop-swift) | [![Build Status](https://img.shields.io/travis/material-motion/material-motion-pop-swift/develop.svg)](https://travis-ci.org/material-motion/material-motion-pop-swift/) | [![codecov](https://img.shields.io/codecov/c/github/material-motion/material-motion-pop-swift/develop.svg)](https://codecov.io/gh/material-motion/material-motion-pop-swift/) | [![CocoaPods Compatible](https://img.shields.io/cocoapods/v/.svg)](https://cocoapods.org/pods//) | [![Platform](https://img.shields.io/cocoapods/p/.svg)](http://cocoadocs.org/docsets/) | [![Docs](https://img.shields.io/cocoapods/metrics/doc-percent/.svg)]() | [![Open issues](https://img.shields.io/github/issues/material-motion/material-motion-pop-swift.svg)](https://github.com/material-motion/material-motion-pop-swift/issues/) |
| [material-motion-swift](https://github.com/material-motion/material-motion-swift) | [![Build Status](https://img.shields.io/travis/material-motion/material-motion-swift/develop.svg)](https://travis-ci.org/material-motion/material-motion-swift/) | [![codecov](https://img.shields.io/codecov/c/github/material-motion/material-motion-swift/develop.svg)](https://codecov.io/gh/material-motion/material-motion-swift/) | [![CocoaPods Compatible](https://img.shields.io/cocoapods/v/.svg)](https://cocoapods.org/pods//) | [![Platform](https://img.shields.io/cocoapods/p/.svg)](http://cocoadocs.org/docsets/) | [![Docs](https://img.shields.io/cocoapods/metrics/doc-percent/.svg)]() | [![Open issues](https://img.shields.io/github/issues/material-motion/material-motion-swift.svg)](https://github.com/material-motion/material-motion-swift/issues/) |

## Web platform support

| Library | Build status | Coverage | Version | Issues |
|---------|:------------:|:--------:|:-------:|:------:|
| [indefinite-observable-js](https://github.com/material-motion/indefinite-observable-js) | [![Build Status](https://img.shields.io/travis/material-motion/indefinite-observable-js/develop.svg)](https://travis-ci.org/material-motion/indefinite-observable-js/) | [![codecov](https://img.shields.io/codecov/c/github/material-motion/indefinite-observable-js/develop.svg)](https://codecov.io/gh/material-motion/indefinite-observable-js/) | [![Release](https://img.shields.io/npm/v/indefinite-observable.svg)](https://www.npmjs.com/package/indefinite-observable/) | [![Open issues](https://img.shields.io/github/issues/material-motion/indefinite-observable-js.svg)](https://github.com/material-motion/indefinite-observable-js/issues/) |
| [material-motion-js](https://github.com/material-motion/material-motion-js) | [![Build Status](https://img.shields.io/travis/material-motion/material-motion-js/develop.svg)](https://travis-ci.org/material-motion/material-motion-js/) | [![codecov](https://img.shields.io/codecov/c/github/material-motion/material-motion-js/develop.svg)](https://codecov.io/gh/material-motion/material-motion-js/) | [![Release](https://img.shields.io/npm/v/material-motion.svg)](https://www.npmjs.com/package/material-motion/) | [![Open issues](https://img.shields.io/github/issues/material-motion/material-motion-js.svg)](https://github.com/material-motion/material-motion-js/issues/) |

## Misc libraries

| Library | Build status | Coverage | Version | Issues |
|---------|:------------:|:--------:|:-------:|:------:|
| [apidiff](https://github.com/material-motion/apidiff/) | [![Build Status](https://img.shields.io/travis/material-motion/apidiff/develop.svg)](https://travis-ci.org/material-motion/apidiff/) | [![codecov](https://img.shields.io/codecov/c/github/material-motion/apidiff/develop.svg)](https://codecov.io/gh/material-motion/apidiff/) | [![Release](https://img.shields.io/github/release/material-motion/apidiff.svg)](https://github.com/material-motion/apidiff/releases/latest/) | [![Open issues](https://img.shields.io/github/issues/material-motion/apidiff.svg)](https://github.com/material-motion/apidiff/issues/) |
| [chrome-inspector](https://github.com/material-motion/chrome-inspector/) | [![Build Status](https://img.shields.io/travis/material-motion/chrome-inspector/develop.svg)](https://travis-ci.org/material-motion/chrome-inspector/) | [![codecov](https://img.shields.io/codecov/c/github/material-motion/chrome-inspector/develop.svg)](https://codecov.io/gh/material-motion/chrome-inspector/) | [![Release](https://img.shields.io/github/release/material-motion/chrome-inspector.svg)](https://github.com/material-motion/chrome-inspector/releases/latest/) | [![Open issues](https://img.shields.io/github/issues/material-motion/chrome-inspector.svg)](https://github.com/material-motion/chrome-inspector/issues/) |
| [direct-web](https://github.com/material-motion/direct-web/) | [![Build Status](https://img.shields.io/travis/material-motion/direct-web/develop.svg)](https://travis-ci.org/material-motion/direct-web/) | [![codecov](https://img.shields.io/codecov/c/github/material-motion/direct-web/develop.svg)](https://codecov.io/gh/material-motion/direct-web/) | [![Release](https://img.shields.io/github/release/material-motion/direct-web.svg)](https://github.com/material-motion/direct-web/releases/latest/) | [![Open issues](https://img.shields.io/github/issues/material-motion/direct-web.svg)](https://github.com/material-motion/direct-web/issues/) |
| [material-motion](https://github.com/material-motion/material-motion/) | [![Build Status](https://img.shields.io/travis/material-motion/material-motion/develop.svg)](https://travis-ci.org/material-motion/material-motion/) | [![codecov](https://img.shields.io/codecov/c/github/material-motion/material-motion/develop.svg)](https://codecov.io/gh/material-motion/material-motion/) | [![Release](https://img.shields.io/github/release/material-motion/material-motion.svg)](https://github.com/material-motion/material-motion/releases/latest/) | [![Open issues](https://img.shields.io/github/issues/material-motion/material-motion.svg)](https://github.com/material-motion/material-motion/issues/) |
| [milemarker](https://github.com/material-motion/milemarker/) | [![Build Status](https://img.shields.io/travis/material-motion/milemarker/develop.svg)](https://travis-ci.org/material-motion/milemarker/) | [![codecov](https://img.shields.io/codecov/c/github/material-motion/milemarker/develop.svg)](https://codecov.io/gh/material-motion/milemarker/) | [![Release](https://img.shields.io/github/release/material-motion/milemarker.svg)](https://github.com/material-motion/milemarker/releases/latest/) | [![Open issues](https://img.shields.io/github/issues/material-motion/milemarker.svg)](https://github.com/material-motion/milemarker/issues/) |
| [starmap](https://github.com/material-motion/starmap/) | [![Build Status](https://img.shields.io/travis/material-motion/starmap/develop.svg)](https://travis-ci.org/material-motion/starmap/) | [![codecov](https://img.shields.io/codecov/c/github/material-motion/starmap/develop.svg)](https://codecov.io/gh/material-motion/starmap/) | [![Release](https://img.shields.io/github/release/material-motion/starmap.svg)](https://github.com/material-motion/starmap/releases/latest/) | [![Open issues](https://img.shields.io/github/issues/material-motion/starmap.svg)](https://github.com/material-motion/starmap/issues/) |
| [sublime](https://github.com/material-motion/sublime/) | [![Build Status](https://img.shields.io/travis/material-motion/sublime/develop.svg)](https://travis-ci.org/material-motion/sublime/) | [![codecov](https://img.shields.io/codecov/c/github/material-motion/sublime/develop.svg)](https://codecov.io/gh/material-motion/sublime/) | [![Release](https://img.shields.io/github/release/material-motion/sublime.svg)](https://github.com/material-motion/sublime/releases/latest/) | [![Open issues](https://img.shields.io/github/issues/material-motion/sublime.svg)](https://github.com/material-motion/sublime/issues/) |
| [tools](https://github.com/material-motion/tools/) | [![Build Status](https://img.shields.io/travis/material-motion/tools/develop.svg)](https://travis-ci.org/material-motion/tools/) | [![codecov](https://img.shields.io/codecov/c/github/material-motion/tools/develop.svg)](https://codecov.io/gh/material-motion/tools/) | [![Release](https://img.shields.io/github/release/material-motion/tools.svg)](https://github.com/material-motion/tools/releases/latest/) | [![Open issues](https://img.shields.io/github/issues/material-motion/tools.svg)](https://github.com/material-motion/tools/issues/) |


