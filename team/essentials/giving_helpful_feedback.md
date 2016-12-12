---
layout: page
---

# Giving helpful feedback

[A comic on feedback](http://www.lunarbaboon.com/comics/feedback.html).

## Code review

Why do we review code?

1. To provide an opportunity for receiving feedback on code before it lands.
2. To increase awareness of solutions across platforms.
3. To evaluate incremental adherence to the starmap.
4. To evaluate adherence to language style.

Helpful code review feedback is **actionable**. The feedback receiver should have a clear path
towards resolving the feedback.

> Unhelpful: "This solution isn't going to work."
> Helpful: "I see another way to solve this problem. What are your thoughts on `<actionable solution>`?"

Helpful code review feedback is **relevant** and doesn't unnecessarily increase the scope of the
change. A good rule of thumb is to ask "can this be solved in a follow-up diff?" If the answer is
yes, file an issue and follow-up.

> Unhelpful: "Can you also fix this <unrelated problem>?"
> Helpful: "I've filed `[this bug](link)` to track fixing a separate problem I noticed as part of
> this review."

Helpful code review feedback is **constructive**.

> Unhelpful: "Why did you build it this way?"
> Helpful: "I'd like to learn more about why this change was made: can you add some background
> information to the diff's description?"
