---
layout: page
title: Photo
status:
  date: Nov 16, 2016
  is: Draft
knowledgelevel: L1
library: transitions-catalog
depends_on:
  - /starmap/specifications/interactions/transitions/Transition
  - /starmap/specifications/plans/AppliesVelocity
  - /starmap/specifications/plans/Draggable
  - /starmap/specifications/plans/PausesSpring
  - /starmap/specifications/plans/TransitionTween
  - /starmap/specifications/plans/TransitionSpring
---

# Photo specification

```swift
import Transitions

import DirectManipulation
import TransitionTween
import TransitionSpring

protocol PhotoTransitionContextElement {
  func imageElementForTransition() -> UIImageView
}

protocol PhotoForeViewController {
  func imageElementForTransition() -> UIImageView
}

class PhotoTransitionDirector: TransitionDirector {
  let transition: Transition
  required init(transition: Transition) {
    self.transition = transition
  }

  let replicator = ViewReplicator()

  var replicaImageElement: Element?
  var foreImageElement: Element?

  deinit {
    foreImageElement?.isHidden = false
  }

  func setUp() {
    let fadeIn = TransitionTween(.opacity,
                                 transition: transition,
                                 segment: .entire,
                                 back: 0,
                                 fore: 1)
    fadeIn.timingFunction = .easeInEaseOut
    transition.runtime.addPlan(fadeIn, to: transition.fore.element)

    if let contextElement = transition.contextElement as? PhotoTransitionContextElement {
      let imageElement = contextElement.imageElementForTransition()
      let replica = replicator.replicate(view: imageElement, into: transition.containerElement)

      let foreView = transition.foreViewController.view!
      foreImageElement = (transition.fore as! PhotoForeViewController).imageElementForTransition()
      let imageSize = imageElement.image!.size

      let fitScale = min(foreView.bounds.width / imageSize.width,
                         foreView.bounds.height / imageSize.height)
      let fitSize = CGSize(width: fitScale * imageSize.width, height: fitScale * imageSize.height)

      let forePosition = foreImageView!.superview!.convert(foreImageView!.center, to: transition.containerView)
      let plans = [
        TransitionSpring(.layerSize,
                         transition: transition,
                         back: replica.bounds.size,
                         fore: fitSize),
        TransitionSpring(.layerPosition,
                         transition: transition,
                         back: replica.layer.position,
                         fore: forePosition),
        TransitionSpring(.layerScaleXY,
                         transition: transition,
                         back: CGSize(width: 1, height: 1),
                         fore: CGSize(width: 1, height: 1)),
        TransitionSpring(.layerRotation,
                         transition: transition,
                         back: 0,
                         fore: 0)
        ]
      for plan in plans {
        transition.runtime.addPlan(plan, to: replica.layer)
      }
      foreImageElement!.isHidden = true

      replicaImageElement = replica
    }
  }

  func add(_ gestureRecognizer: GestureRecognizer) {
    transition.runtime.addPlan(PausesSpring(.size, whileActive: gestureRecognizer),
                               to: replicaImageElement!)
    transition.runtime.addPlan(PausesSpring(.position, whileActive: gestureRecognizer),
                               to: replicaImageElement!)
    transition.runtime.addPlan(PausesSpring(.rotation, whileActive: gestureRecognizer),
                               to: replicaImageElement!.layer)
    transition.runtime.addPlan(PausesSpring(.scale, whileActive: gestureRecognizer),
                               to: replicaImageElement!.layer)

    switch gestureRecognizer {
    case let pan as UIPanGestureRecognizer:
      transition.runtime.addPlan(MapDragRadius(150,
                                               duration: transition.window.duration,
                                               panGestureRecognizer: pan),
                                 to: transition.timeline)

      transition.runtime.addPlan(Draggable(withGestureRecognizer: pan),
                                 to: replicaImageElement!)
    case let rotate as UIRotationGestureRecognizer:
      transition.runtime.addPlan(Rotatable(withGestureRecognizer: rotate),
                                 to: replicaImageElement!)
    case let pinch as UIPinchGestureRecognizer:
      transition.runtime.addPlan(Pinchable(withGestureRecognizer: pinch),
                                 to: replicaImageElement!)
    default:
      ()
    }
  }
}

// Dismissal
extension PhotoTransitionDirector {
  class func setUpFore(_ fore: Fore, dismisser: TransitionDismisser) {
    let gestures = [TapGestureRecognizer(),
                    PanGestureRecognizer(),
                    PinchGestureRecognizer(),
                    RotationGestureRecognizer()]
    for gestureRecognizer in gestures {
      dismisser.dismiss(whenGestureRecognizerBegins: gestureRecognizer)

      fore.view.addGestureRecognizer(gestureRecognizer)
    }
  }
}
```
