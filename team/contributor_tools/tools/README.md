Usage: `mdm tools`

    Enumerates all tools used by the material motion team and
    prints out installation instructions if the tool is not
    installed.

Usage: `mdm tools status`

    Enumerates all tools used by the material motion team.

Usage: `mdm tools install`

    Installs tools used by the material motion team.

## What is a tool?

A `tool` is a command that is executable from the command line.
For example, `arc` is a tool.

## How to add new tools

1. Add a `check_tool` invocation in the tools script.
2. Add an installers/<tool>.md file explaining how to install the tool.
3. Add an installers/<tool>.installer script that installs the tool.
