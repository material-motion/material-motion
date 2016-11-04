---
layout: page
title: Sparkle dialog
---

# Sparkle dialog demo

![]({{ site.url }}/assets/sparkledialog.gif)

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
      let size = scrimView.bounds.size

      when(.collapsed) { make in
        make[contentView].spring(.layerOpacity, to: contentView.layer.opacity)
        make[scrimView].spring(.layerSize, to: size)

        make[titleLabel].spring(.layerPositionY,
                                to: titleLabel.layer.position.y)
        make[titleLabel].spring(.layerOpacity, to: 0)
        make[detaillabel].spring(.layerPositionY,
                                 to: dialogView.detaillabel.layer.position.y)
        make[detaillabel].spring(.layerOpacity, to: 0)

        for card in dialogView.cards {
          make[card].spring(.layerRotation, to: 0)
          make[card].spring(.layerPositionX, to: card.layer.position.x)
          make[card].spring(.layerPositionY, to: card.layer.position.y)
        }
      }

      when(.expanded) { make in
        make[contentView].spring(.layerOpacity, to: 1)
        make[scrimView].spring(.layerSize, to: CGSize(width: size.width + 20,
                                                      height: size.height + 20))

        make[titleLabel].spring(.layerPositionY,
                                to: titleLabel.layer.position.y + 5)
        make[titleLabel].spring(.layerOpacity, to: 1)
        make[detaillabel].spring(.layerPositionY,
                                 to: detaillabel.layer.position.y + 5)
        make[detaillabel].spring(.layerOpacity, to: 1)

        let xOffset: [CGFloat] = [-20, 0, 20]
        let rotations: [Double] = [-45, 0, 45]
        for (i, card) in dialogView.cards.enumerated() {
          make[card].spring(.layerRotation, to: rotations[i] * M_PI / 180)
          make[card].spring(.layerPositionX, to: card.layer.position.x + xOffset[i])
          make[card].spring(.layerPositionY, to: card.layer.position.y - 20)
        }
      }

      dialogView.addGestureRecognizer(UITapGestureRecognizer(target: self, action: #selector(didTap)))
    }
