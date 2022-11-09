<?php
namespace Calculation;

class Calculation3 {

    private $path = "";
    private $positionTarget = 0;
    private $positionOther = array();
    private $target = ">";
    private $other = "<";
    private $twostep = "+";
    private $numberOfSteps = array();
    private $prevPositionTarget = 0;
    private $prevPositionOther = array();
    private $sameSpotPositions = array();


    public function __construct(string $path) {
        $this->path = $path;
        $this->positionTarget = $this->whereIs("target");
        $this->positionOther = $this->whereAre("other");
        $this->createEmptyArrays();
    }

    private function createEmptyArrays() {
        $this->numberOfSteps = array_fill_keys(array_keys($this->positionOther), 0);
        $this->sameSpotPositions = array_fill_keys(array_keys($this->positionOther), false);
        $this->prevPositionOther = array_fill_keys(array_keys($this->positionOther), 0);
    }

    private function whereIs($who): int {
        return strpos($this->path, $this->$who);
    }

    private function whereAre($who): array {
        $lastPositionInString = 0;
        while( ($lastPositionInString = strpos($this->path, $this->other, $lastPositionInString)) !== false ) {
            $positions[] = $lastPositionInString;
            $lastPositionInString = $lastPositionInString + strlen($this->other);
        }
        return $positions;
    }

    public function calculation() {
        while(!$this->havePassedAll()) {
            $this->nextStep();
            // return "not passed";    
        }
        return $this->endState();
    }

    private function EndState() {
        foreach($this->numberOfSteps as $id => $steps) {
            $totalSteps[] = $steps . ($this->sameSpotPositions[$id] ? "*" : "");
        }
        return implode(",", $totalSteps);
    }


    private function nextStep() {
        foreach($this->positionOther as $id => $position) {
            if(!$this->hasPassed($position)) {
                $this->numberOfSteps[$id] += 1;
                $this->nextStepOther($id);
            }
        }
        $this->nextStepTarget();
        $this->onTheSameSpot();
    }

    private function onTheSameSpot() {
        foreach($this->positionOther as $id => $position) {
            if($this->positionTarget == $position) {
                $this->sameSpotPositions[$id] = true;
            }
        }
    }

    private function nextStepOther(int $id) {
        if($this->path[$this->positionOther[$id]] == $this->twostep && $this->prevPositionOther[$id] != $this->positionOther[$id]) {
            $this->prevPositionOther[$id] = $this->positionOther[$id];
            return true;
        }
        $this->positionOther[$id]--;
    }

    private function nextStepTarget() {
        if($this->path[$this->positionTarget] == $this->twostep && $this->prevPositionTarget != $this->positionTarget) {
            $this->prevPositionTarget = $this->positionTarget;
            return true;
        }
        $this->positionTarget++;
    }

    private function havePassedAll() {
        return $this->positionTarget >= max($this->positionOther);
    }

    private function hasPassed($position) {
        return $this->positionTarget >= $position;
    }
}