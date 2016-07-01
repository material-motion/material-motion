# Deprecation policy

There will come a time where we have to deprecate an API.

The process for this is:

- An API can be deleted from the code if at least one release has been cut in which the API was marked deprecated.
- An API can only be deleted once all release-blocking clients have moved off of the API.
- Remember: deprecate, then delete. It takes at least two releases to remove an API. The first such release is likely a minor release. The second such release is always a major release (because we're removing functionality).
