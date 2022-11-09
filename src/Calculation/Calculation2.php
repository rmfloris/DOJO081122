<?php
namespace Calculation;

class Calculation2 {

    private $path = "";
    private $positionTarget = 0;
    private $positionOther = 0;
    private $target = ">";
    private $other = "<";
    private $twostep = "+";
    private $numberOfSteps = 0;
    private $prevPositionTarget = 0;
    private $prevPositionOther = 0;

    public function __construct(string $path) {
        $this->path = $path;
        $this->positionTarget = $this->whereIs("target", $this->path);
        $this->positionOther = $this->whereIs("other", $this->path);
    }

    private function whereIs($who, $path): int {
        return strpos($path, $this->$who);
    }

    public function calculation() {
        while(!$this->havePassed()) {
            $this->nextStep();
            // return "not passed";    
        }
        return $this->endState();
    }

    private function EndState() {
        return $this->numberOfSteps . $this->willMeetOnSameSpot();
    }

    private function willMeetOnSameSpot() {
        return ($this->positionTarget == $this->positionOther ? "*" : "");
    }

    private function nextStep() {
        $this->numberOfSteps++;
        $this->nextStepTarget();
        $this->nextStepOther();
    }

    private function nextStepTarget() {
        if($this->path[$this->positionTarget] == $this->twostep && $this->prevPositionTarget != $this->positionTarget) {
            $this->prevPositionTarget = $this->positionTarget;
            return true;
        }
        $this->positionTarget++;
    }

    private function nextStepOther() {
        if($this->path[$this->positionOther] == $this->twostep && $this->prevPositionOther != $this->positionOther) {
            $this->prevPositionOther = $this->positionOther;
            return true;
        }
        $this->positionOther--;
    }

    private function havePassed() {
        return $this->positionTarget >= $this->positionOther;
    }
}