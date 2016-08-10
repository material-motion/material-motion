Usage: `mdm lsc`

    List all available large-scale changes.

Usage: `mdm lsc run <name>`

    Executes the large-scale change defined at `$(mdm dir)/lsc/<name>`.
    
    `Filtering`
    
    A large-scale change will be applied to every repository in the
    material-motion org by default. Use a `filter` script to pick a
    subset of repositories to apply the change to.
    
    Create a script called `filter`:
    
        lsc/<name>/filter
    
    A list of github repository names in the form "<owner>/<name>" can
    be read from stdin.
    
    A list of github repository names in the form "<owner>/<name>" should
    be written to stdout.
    
    `The work`
    
    Each large scale change must have a `work` script. This script will be
    executed once for each repository.
    
    Create a script called `work`:
    
        lsc/<name>/work
    
    args:
      $1: repository specifier, in the form "<owner>/<name>"
    working directory:
      The cloned github repo.

Usage: `mdm lsc preview <name>`

    Preview a large-scale change.
