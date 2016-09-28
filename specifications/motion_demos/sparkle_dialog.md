# Sparkle dialog demo

## Element hierarchy

- `SparkleDialog`
  - `Contents`
    - `Card2`
    - `Card1`
    - `Card3`
    - `Title`
    - `Detail`
    - `Scrim`

## Director

    func setUp(withDialogView dialogView: SparkleDialogView) {
      let size = dialogView.skrimView.bounds.size

      when(.collapsed) { make in
        make[dialogView.contentView].spring(kPOPLayerOpacity, to: dialogView.contentView.layer.opacity)
        make[dialogView.skrimView].spring(kPOPLayerSize, to: size)

        make[dialogView.titleLabel].spring(kPOPLayerPositionY,
                                           to: dialogView.titleLabel.layer.position.y)
        make[dialogView.titleLabel].spring(kPOPLayerOpacity, to: 0)
        make[dialogView.detaillabel].spring(kPOPLayerPositionY,
                                            to: dialogView.detaillabel.layer.position.y)
        make[dialogView.detaillabel].spring(kPOPLayerOpacity, to: 0)

        for card in dialogView.cards {
          make[card].spring(kPOPLayerRotation, to: 0)
          make[card].spring(kPOPLayerPositionY, to: card.layer.position.y)
          make[card].spring(kPOPLayerPositionX, to: card.layer.position.x)
        }
      }

      when(.expanded) { make in
        make[dialogView.contentView].spring(kPOPLayerOpacity, to: 1)
        make[dialogView.skrimView].spring(kPOPLayerSize, to: CGSize(width: size.width + 20,
                                                                    height: size.height + 20))

        make[dialogView.titleLabel].spring(kPOPLayerPositionY,
                                           to: dialogView.titleLabel.layer.position.y + 5)
        make[dialogView.titleLabel].spring(kPOPLayerOpacity, to: 1)
        make[dialogView.detaillabel].spring(kPOPLayerPositionY,
                                            to: dialogView.detaillabel.layer.position.y + 5)
        make[dialogView.detaillabel].spring(kPOPLayerOpacity, to: 1)

        let xOffset: [CGFloat] = [-20, 0, 20]
        let rotations: [Double] = [-45, 0, 45]
        for (i, card) in dialogView.cards.enumerated() {
          make[card].spring(kPOPLayerRotation, to: rotations[i] * M_PI / 180)
          make[card].spring(kPOPLayerPositionY, to: card.layer.position.y - 20)
          make[card].spring(kPOPLayerPositionX, to: card.layer.position.x + xOffset[i])
        }
      }

      dialogView.addGestureRecognizer(UITapGestureRecognizer(target: self, action: #selector(didTap)))
    }
