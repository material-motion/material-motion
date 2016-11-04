# Writing reviewable code

One important aspect of our team's culture is the same, regardless of language or platform: code review. All non-experimental code we write as a team goes through code review before it can be landed in any shared git repository.

Pre-reading: Phabricator's "[Writing reviewable code](https://secure.phabricator.com/book/phabflavor/article/writing_reviewable_code/)" article.

Summarizing the important points:

### Make many small commits

Good examples:

  - A single line fix for a bug.
  - A new class with stub APIs. Follow-up diffs flesh out one feature at a time.

### Write documentation early

Much of what we build is designed to be used by other developers. While self-documenting logic is a good thing to strive for, APIs rarely, if ever, are truly self-documenting.

Include documentation with any new API.

### Break big changes in to smaller changes

Phabricator makes it possible to mark a diff as depending on another diff.

Here's one workflow for doing work on two dependent diffs:

    git fetch # Get the latest from origin
    arc feature foo  # Start a new feature, "foo", based off of origin/develop
    
    # make changes
    
    git commit -am "Some commit"
    arc diff # Creates diff 1

    # Code is out for review....now you want to make more changes

    arc feature bar foo  # Start a new feature, "bar", tracking the "foo" branch
    
    # make changes
    
    git commit -am "Another commit"
    arc diff foo # Creates diff 2

If you need to make changes to foo:

    git checkout foo
    
    # make changes
    
    git commit -am "Additional changes
    arc diff # Updates diff 1
    
    # bar is now pointing to an old sha, let's update it
    git checkout bar
    git rebase foo
    arc diff foo # Updates diff 2
