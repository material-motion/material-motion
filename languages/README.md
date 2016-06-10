Status of this document: **Drafting by schlem**

# Material Motion Grammar

Motion design terminology is fragmented.  What some platforms refer to as "incoming easing" is called "ease out" on others.

The Material Motion team uses this guide to discuss motion across platforms and languages.

For our language to be effective, it must enable the expression of a complete **thought** that accurately describes a piece of interactive motion.  Each **thought** begins with an **action** and is followed by a string of **connectors** and **values**.

## Examples

A simple thought:

> Move by (0,100) over 300ms

| Action | Connector | Value | Connector | Value |
| -- | -- | -- | -- | -- |
| Move | by | (0,100) | over | 300ms |

or a more complex one:

> Move from (0,0) to (0,100) over 300ms with Easing

| Action | Connector | Value | Connector | Value | Connector | Value | Connector | Value |
| -- | -- | -- | -- | -- | -- | -- | -- | -- |
| Move | from | (0,0) | to | (0,100) | over | 300ms | with | Easing |

<!--

LGTM:

-->
