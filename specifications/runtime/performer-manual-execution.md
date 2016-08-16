# Performer manual execution specification

An Performer can choose to implement an update function that will be called many times per second.

**Manual execution API**: Define an optional API that allows performers to implement an update function.

> The Performer may choose not to implement this API.

The update function will be called each time the platform will draw a new frame. The performer may use this method to perform time-based calculations. The performer is **not** expected to perform any rendering during this update event.

The method returns an activity state enumeration. This enumeration has two states: active and at rest.

Example pseudo-code:

    enum ActivityState {
      .Active
      .AtRest
    }
    
    protocol ManuallyExecutingPerformer {
      function update(millisecondsSinceLastUpdate) -> ActivityState
    }
