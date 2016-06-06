# Directors

The following Directors represent minimum levels of expression we'd like to achieve.

## Squishable

<video width="200" muted="" autoplay="yes" loop="" src="../_assets/squash-and-stretch.mp4"></video>

Director pseudo-code:

    setup() {
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
    
    onTouchesGesture {
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

## Photo Album

<video width="200" muted="" autoplay="yes" loop="" src="../_assets/photo-album.mp4"></video>
