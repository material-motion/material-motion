# Team practices

## Line length

For code, we enforce a loose 100 character line length. Be reasonable.

For documentation we enforce a strict 100 character line length. We prefer narrow columns of dense text.

The exception to the above is GitBook markdown. The GitBook editor is designed as a what-you-see-is-what-you-get editor. Each "line" in GitBook markdown is a paragraph, and therefor has no artificial line length.

## Copyright comments

All files **must** have the following comment. There should be no whitespace nor characters before it. Be sure to inspect auto-generated files and open packages, such as Xcode Playgrounds; they often have files that aren't easily seen.


    /*
    Copyright 2016-present The Material Motion Authors. All Rights Reserved.

    Licensed under the Apache License, Version 2.0 (the "License");
    you may not use this file except in compliance with the License.
    You may obtain a copy of the License at

    http://www.apache.org/licenses/LICENSE-2.0

    Unless required by applicable law or agreed to in writing, software
    distributed under the License is distributed on an "AS IS" BASIS,
    WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
    See the License for the specific language governing permissions and
    limitations under the License.
    */

## File names

File names should not have spaces in them.
