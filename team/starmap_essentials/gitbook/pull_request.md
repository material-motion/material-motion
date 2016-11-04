---
layout: page
---

# Creating a GitBook pull request

These steps explain how to create a pull request for one of our GitBook books. It assumes you're modifying this book, but the commands apply to other books as well.

These commands assume that you have already created a branch in GitBook and made the changes on that branch.

    # First-time setup
    mkdir team
    cd team
    git init
    git remote add gitbook https://git.gitbook.com/material-motion/material-motion-team.git
    git remote add origin git@github.com:material-motion/material-motion-team.git
    
    # Update the branches
    git fetch gitbook origin
    # Enter your GitBook email/password
    
    # Create a branch for your GitBook branch
    git checkout -b yourbranch gitbook/yourbranch
    
    # Push the branch to GitHub
    git push origin yourbranch
    
    # Start a pull request on the web ui

---

               |\___/|
              (,\  /,)\
              /     /  \       DRAGON SAYS HALT:
             (@_^_@)/   \      DO NOT MERGE GITBOOK PULL
              W//W_/     \     REQUESTS VIA GITHUB UI.
            (//) |        \    
          (/ /) _|_ /   )  \
        (// /) '/,_ _ _/  (~^-.
      (( // )) ,-{        _    `.
     (( /// ))  '/\      /       \
     (( ///))     `.   {       }  \
      ((/ ))    .----~-.\   \-'    ~-__
               ///.----..>   \ \_      ~--____
                ///-._ _  _ _}    ~--------------

---

**Heed the dragon: do not merge the pull request via GitHub's web UI**.

Once your pull request is LGTM'd, push your branch back to GitBook and merge the branch via GitBook's web UI:

    git push yourbranch gitbook/yourbranch
    
    # Merge your branch into master on GitBook

Optional: you can now follow our typical [mirroring workflow](updating_our_books.md) to update the GitHub repo with your latest changes.
