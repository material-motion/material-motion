---
layout: page
title: Server
status:
  date: Oct 25, 2016
  is: Drafting
---

# Server

TODO: Flesh out the role of the server in relation to the runtime.

TODO: Formalize the following content as a protocol.

The Server will need a variety of hooks in to the system. Notably it requires the following **outputs**:

- List of all Plans types. (the available "motion language")
- List of all active Runtime instances.
- List of all Director types.
- List of all active Director instances.
- Directors can expose configurable settings.
- For each Runtime:
  - List of active Executors.
  - List of Plans associated with targets.

It also requires the following **inputs**:

- Transactions are committable over the wire to a specific runtime on a server.
- Changing Plan values? Unclear how this would work.
- Pausing/unpausing a Runtime.

It should be possible to connect to the server and send/receive the above protocol.

MVP tool connecting to server would be able to inspect active Runtimes.

Tool features:

- Creating new Transactions.

This server could also provide a web-accessible interface. This would allow the "tool" to be something downloaded from the server.

**Plugins**: The Server requires a good amount of access to internal APIs.
