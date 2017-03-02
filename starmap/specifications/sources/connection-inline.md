---
layout: page
title: Inline connection type
status:
  date: March 2, 2017
  is: Stable
interfacelevel: L2
implementationlevel: L4
library: reactive-motion
depends_on:
  - /starmap/specifications/observable/MotionObservable
---

# Inline connection specification

This is the engineering specification for an **inline** MotionObservable connection implementation.

## MVP

### Return a motion observable

```swift
return MotionObservable { observer in
  // Connect to a source
  return {
    // Disconnect from the source
  }
}
```

### Instantiate the source inline

```swift
return MotionObservable { observer in
  let someSource = Source()
  
  ...
}
```

### Start the source on connection

This should be done after configuring the source and before returning the disconnect method.

```swift
return MotionObservable { observer in
  ...
  
  someSource.start()
  
  return {
    ...
  }
}
```

### Stop the source on disconnection

This may require some amount of teardown to occur.

```swift
return MotionObservable { observer in
  ...
  return {
    someSource.stop()
  }
}
```
