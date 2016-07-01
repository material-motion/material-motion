    NAME
         mdm - extendable tools for automating material motion work
    
    SYNOPSIS
         mdm command [args]

## Usage

Add the bin scripts to your path:

    echo "export PATH=$(dirname $(find $(pwd) -regex '.*bin/mdm')):\$PATH"

Add the output of the above command to your bash profile (example: `~/.bash_profile`).

See available commands by running:

    mdm help

### Adding new commands

`mdm` is a convention-oriented modular tool. Installing a new command is as simple as creating a new
directory next to the mdm repo containing two files: your command's script and a README.md.

    mdm/
      bin/
        mdm
    yourcommand/
      yourcommand
      README.md
    yourothercommand/
      yourothercommand
      README.md
