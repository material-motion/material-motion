# Directors

The following Directors represent minimum levels of expression we'd like to achieve.

## Fade In

What it does: fades in a view.

What's required to build it:

- Tween Language with fadeIn term

Director pseudo-code:

    Director(view) {
      self.view = view
    }

    function setup() {
      self.view.addExpression(Tween().fadeIn())
    }

## Fade In (with runtime)

What it does: fades in a view via a Runtime.

What's required to build it:

- Tween Language with fadeIn term
- A Runtime

Director pseudo-code:

    Director(view) {
      self.view = view
    }

    function setup() {
      var transaction = Transaction()
      transaction.addExpression(Tween().fadeIn(), toView: self.view)
      runtime.commit(transaction)
    }

## Squishable

<video width="200" muted="" autoplay="yes" loop="" src="../_assets/squash-and-stretch.mp4"></video>

What it does: a circle follows the user's finger around while squashing/stretching in the direction of movement.

What's required to build it:

- Squishable Intention
- Runtime
- Gesture recognizers
- Transient views

Director pseudo-code:

    function setup() {
      dotView = View()
      dotView.position = runtime.stage.center
      dotView.size = {80, 80}
      dotView.backgroundColor = blue
      dotView.cornerRadius = dotView.size.width / 2

      var transaction = Transaction()
      transaction.registerTransientView(dotView)
      transaction.addExpression(PrinciplesOfAnimation().squishable(), toView: dotView)
      transaction.addGesture(TouchesGesture(target: self))
      runtime.commit(transaction)
    }
    
    function onTouchesGesture() {
      position = gesture.locationInView(runtime.stage)

      var expression = Forces()
      if (gesture.state != UIGestureRecognizerStateEnded) {
        expression = expression.attachedTo(position)
      } else {
        expression = expression.attachedTo(runtime.stage.center)
      }
      expression = expression.withSpringCoefficient(400)
      
      var transaction = Transaction()
      transaction.setExpression(expression, withName: "attachment", toView: dotView)
      runtime.commit(transaction)
    }

## Photo Album transition

<video width="200" muted="" autoplay="yes" loop="" src="../_assets/photo-album.mp4"></video>

    function setup() {
      imageView = self.contextView # Always from the left side

      rightView = rightViewController.view
      rightImageView = rightViewController.imageViewForTransition

      fitScale = min(rightView.width / imageView.width, rightView.height / imageView.height)
      fitSize = Size(fitScale * imageView.width, fitScale * imageView.height)

      var transaction = Transaction()
      
      transaction.addExpression(TimelineTween().fadeIn(), toView: rightView)
      transaction.addExpression(Visibility().hidden(), toView: rightImageView)

      rightFrame = Rect(rightView.x - fitSize.width / 2, rightView.y - fitSize.height / 2,
                        fitSize.width, fitSize.height)

      expression = Gesturable().draggable().and.rotatable().and.pinchable()
      transaction.addExpression(expression, toView: imageView)
      
      expression = Springs().attachFrameTo(rightFrame).from(imageView.bounds)
      expression = expression.and.attachZRotationTo(0).from(0)
      expression = expression.and.attachScaleTo(1).from(0)
      transaction.addExpression(expression, toView: imageView)
      
      transaction.addGesture(TapGesture(target: self))
      
      runtime.commit(transaction)
    }
