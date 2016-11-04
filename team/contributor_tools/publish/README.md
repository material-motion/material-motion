Usage: `mdm publish github [kind] [owner] [name]`

    Publishes the current git directory to GitHub.
    
    Must be run from a non-bare git repository.
    
    [kind]  Required. Must be one of android, apple, javascript, or tools.
    [owner] Optional. Publish the repo under this owner.
    [name]  Optional. Use this name for the repo.

Usage: `mdm publish phabricator [owner] [name]`

    Creates a new Diffusion repository in phabricator for
    the current git repository.
    
    Must be run from a non-bare git repository.
    
    [owner] Optional. Publish the repo under this owner.
    [name]  Optional. Use this name for the repo.
