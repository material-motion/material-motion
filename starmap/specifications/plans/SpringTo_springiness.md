---
layout: page
title: Springiness
status:
  date: Nov 1, 2016
  is: Draft
---

# Springiness feature specification

```swift
func SpringConfigurationWithBouncinessAndSpeed(bounciness, speed)

enum SpringBounciness {
  case Bouncy(scalar)
  case NotBouncy
  case Exponential
}

enum SpringSpeed {
  case Fast(scalar)
  case Slow(scalar)
}
```
