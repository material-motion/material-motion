---
layout: page
title: Photo
status:
  date: Nov 16, 2016
  is: Draft
---

# Photo specification

```
import Transitions

import DirectManipulation
import TransitionTween
import SpringTween

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

      transition.runtime.addPlan(TransitionSpring(.size,
                                                  transition: transition,
                                                  back: replica.bounds.size,
                                                  fore: fitSize),
                                 to: replica)
      let forePosition = foreImageElement!.superElement!.convert(foreImageElement!.center, to: transition.containerElement)
      transition.runtime.addPlan(TransitionSpring(.position,
                                                  transition: transition,
                                                  back: replica.layer.position,
                                                  fore: forePosition),
                                 to: replica)
      transition.runtime.addPlan(TransitionSpring(.scale,
                                                  transition: transition,
                                                  back: CGSize(width: 1, height: 1),
                                                  fore: CGSize(width: 1, height: 1)),
                                 to: replica.layer)
      transition.runtime.addPlan(TransitionSpring(.rotation,
                                                  transition: transition,
                                                  back: 0,
                                                  fore: 0),
                                 to: replica.layer)
      foreImageElement!.isHidden = true

      replicaImageElement = replica
    }
  }

  func add(_ gestureRecognizer: GestureRecognizer) {
    transition.runtime.addPlan(PauseSpring(.size, whileActive: gestureRecognizer),
                               to: replicaImageElement!)
    transition.runtime.addPlan(PauseSpring(.position, whileActive: gestureRecognizer),
                               to: replicaImageElement!)
    transition.runtime.addPlan(PauseSpring(.rotation, whileActive: gestureRecognizer),
                               to: replicaImageElement!.layer)
    transition.runtime.addPlan(PauseSpring(.scale, whileActive: gestureRecognizer),
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
