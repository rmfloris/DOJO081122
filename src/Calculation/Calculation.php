<?php
namespace Calculation;

class Calculation {

    private $path = "";
    private $positionTarget = 0;
    private $positionOther = 0;
    private $target = ">";
    private $other = "<";
    private $twostep = "+";

    public function __construct(string $path) {
        $this->path = $this->makeSimplePath($path);
        $this->positionTarget = $this->whereIs("target", $this->path);
        $this->positionOther = $this->whereIs("other", $this->path);
    }

    private function makeSimplePath(string $path) :string {
        return preg_replace("/\+/", "..", $path);
        // preg_replace('/\\+/', '..', '>.+<', -1, $count);
    }

    private function whereIs($who, $path): int {
        return strpos($path, $this->$who);
    }

    private function willMeetOnSameSpot(): bool {
        return (($this->positionOther - $this->positionTarget) % 2 == 0);
    }

    private function neededSteps(): int {
        return ceil(($this->positionOther - $this->positionTarget)/2);
        /**
         * + needs two steps
         * how many "two steps" between start and end?
         * >.+< -> 2*
         * replace with ".."?
         */
    }

    public function calculation() {
        return $this->neededSteps() . ($this->willMeetOnSameSpot() ? "*" : "");
    }
}