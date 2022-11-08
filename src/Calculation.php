<?php

class Calculation {

    private int $positionTarget = 0;
    private int $positionOther = 0;
    private string $target = ">";
    private string $other = "<";

    public function __construct(string $path) {
        $this->positionTarget = $this->whereIs("target", $path);
        $this->positionOther = $this->whereIs("other", $path);
    }

    private function whereIs($who, $path): int {
        return strpos($path, $this->$who);
    }

    private function willMeetOnSameSpot(): bool {
        return (($this->positionOther - $this->positionTarget) % 2 == 0);
    }

    private function neededSteps(): int {
        return ceil(($this->positionOther - $this->positionTarget)/2);
        // return 0;
    }

    public function calculation() {
        // >.<
        /**
         * approach:
         * will they meet on the same spot? -> check distance between > and < -> uneven, they will meet
         */

        return "{". $this->neededSteps() . ($this->willMeetOnSameSpot() ? "*" : "") ."}";

        /** 
         * return
         * {1*} -> 1 step to meet and end up at the same spot *
         * {2} -> 2 steps to meet and don't end up at the same spot
         */
    }


}