# Activity state change event

Fire an observable event when the at rest/active state changes.

**activity state changed API**: Provide a public API for registering an "activity state did change" listener.

    Scheduler {
      public function addActivityStateObserver(function)
    }
    
    scheduler.addActivityStateObserver(function(newState) {
      // React to state change
    })

**Many observers**: Allow many observers to be registered.
