# DOJO

## KATA 08-11-2022
You were hired by CIA to follow a man who, based on their sources, will meet the CIA top #1 fugitive.
You should keep a close eye in everyone that he encounters during his walk and send the final report to CIA.
CIA has cameras all around the world, and they will provide you with real time information about your target.
It is part of your job to create an algorithm which can help CIA to identify the criminals based on the input they will provide you.
In the end, your final report should be a list of number of steps your target walked to meet every single person in his way.
A '*' should be used to identify everytime that he was in the same spot with another person.
The challenge is split in 4 different parts. In all the phases the following are applied.

'.' identifies the path.
In each round every person in the path give one step.
The target is always the most left person (indicated by '>') and he (most of the time) walks to the right.
All the other people in the path is indicated by '<' and (most of the time) walks to the left.
All the inputs must contain:

NO null values
ONLY valid chars
ONLY 1 target in the path and this one must always be the most left person

Assertions must use Assertionjs

Find description, input and output example of each phase.

### PHASE 1
This phase consists in having only 1 target and 1 person in the path.

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

### PHASE 4
The target and other people noticed that they are being followed, and now they are going forward and backward.
This is the last phase, if you succeed, I am sure you will get them.
When you find the symbol '@', it means the person has changed direction.
'@' is also a spot and count as 1 step.
When the first person reaches the '@', the spot is converted in a normal spot.
If someone reaches the first or last position of the path (no matter if it is a '@') it means that there is no more steps to count, and the report must finish. 
All the previous rules remains.

INPUT: >...@..<
OUTPUT: {}
INPUT >...@..<..<
OUTPUT: {X, X}
