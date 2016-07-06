pather coding challenge

Given an input file containing a rectangular block of dot
characters ('.') and two or more hash characters ('#'), write a
program called 'pather' that writes to an output file the same
block of dot characters, but with the '#' characters connected
by asterisks ('*'). The pather program may be written in any language.

The command will be invoked like this:

  pather input.txt output.txt

The rules for the path:

* No diagonals.
* Only change direction once per pair of '#' characters.
* Start with a vertical line and then complete with a horizontal line.
