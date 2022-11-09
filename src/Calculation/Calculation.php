<?php
namespace Calculation;

class Calculation {

    private $positionTarget = 0;
    private $positionOther = 0;
    private $target = ">";
    private $other = "<";

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
        return "{". $this->neededSteps() . ($this->willMeetOnSameSpot() ? "*" : "") ."}";
    }
}