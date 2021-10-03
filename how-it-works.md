# How it works

We hook into [PHPStan](https://phpstan.org)s rule system to be able to use its 
nice type inference.

For each node that is analyzed, we do the following:

- Does it declare something new?
  - `[Yes]` 
    - Create a new range using its FQN
    - Collect other metadata, such as hover info, etc...
- Does it reference something?
  - `[Yes]` 
    - Create a new range that references the FQN of whatever this 
      reference points to