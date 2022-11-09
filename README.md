# DOJO081122
You were hired by CIA to follow a man who, based on their sources, will meet the CIA top #1 fugitive.
You should keep a close eye in everyone that he encounters during his walk and send the final report to CIA.

CIA has cameras all around the world, and they will provide you with real time information about your target.

It is part of your job to create an algorithm which can help CIA to identify the criminals based on the input they will provide you.

### PHASE 1
TODO

### PHASE 2
Sometimes you will find a spot where it is harder to move on. Those special spots are indicated as '+'.
You require 2 steps in order to move out from them.
All the previous rules remains.

```
INPUT: >.+< 
OUTPUT: {2*}
```

### PHASE 3
1 target and multiple people in the path. Do not lose him, keep track of all people the target encounters.
All the previous rules remains.

```
INPUT: >..<...< 
OUTPUT: {2,4}

assertLinesMatch(listOf("2,4"),followTarget.follow(">..<...<"))
assertLinesMatch(listOf("3,4*,6*"),followTarget.follow(">..+<.<++"))
assertLinesMatch(listOf("5,6*,10"),followTarget.follow("...++>..++...<.<+<.."))
```
