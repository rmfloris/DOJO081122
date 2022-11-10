<?php
namespace Calculation;

class Calculation4 {

    private $path = "";
    private $twostep = "+";
    private $switchWalkingDirection = "@";
    private $target = array(
                        "symbol" => ">",
                        "walkingDirection" => 1
                        );
    private $other = array(
                        "symbol" => "<",
                        "walkingDirection" => -1
                        );

    private $information = array();
    /**
     * information = array(
     *      target => array(
     *          0 => array (
     *              position = 8
     *              numberOfSteps = 0
     *              prevPosition = 0
     *              metOnSameSpot = false
     *              walkingDirection = 1
     *          )
     *      )
     *      other => array (
     *          0 => array (
     *              position = 8
     *              numberOfSteps = 0
     *              prevPosition = 0
     *              metOnSameSpot = false
     *              walkingDirection = -1
     *          )
     *      ) 
     *  )
     */    

    public function __construct(string $path) {
        $this->path = $path;
        $this->information["target"] = $this->gatherInformationAbout("target");
        $this->information["other"] = $this->gatherInformationAbout("other");
    }

    private function gatherInformationAbout($who): array {
        $positions = $this->whereAre($who);
        foreach($positions as $id => $position){
            $information[$id] = array(
                "position" => $position,
                "numberOfSteps" => 0,
                "prevPosition" => 0,
                "metOnSameSpot" => false,
                "walkingDirection" => $this->getWalkingDirection($who)
            );
        }
        return $information;
    }

    private function getWalkingDirection($who) {
        return $this->{$who}["walkingDirection"];
    }

    private function whereAre($who): array {
        $lastPositionInString = 0;
        while( ($lastPositionInString = strpos($this->path, $this->{$who}["symbol"], $lastPositionInString)) !== false ) {
            $positions[] = $lastPositionInString;
            $lastPositionInString = $lastPositionInString + strlen($this->{$who}["symbol"]);
        }
        return $positions;
    }

    public function calculation() {
        while(!$this->havePassedAll() && !$this->endOfPath()) {
            $this->nextStep();
        }
        return $this->endState();
    }

    private function endOfPath() {
        if($this->information["target"][0]["position"] + $this->calculatedNextStep("target") < 0) {
            return true;
        }
        foreach($this->information["other"] as $id => $info) {
            if($info["position"] + $this->calculatedNextStep("other", $id) > strlen($this->path)) {
                return true;
            }
        }
        return false;
    }

    private function calculatedNextStep(string $who, int $id = 0): int {
        return $this->information[$who][$id]["walkingDirection"];
    }

    private function EndState() {
        if($this->endOfPath()) { return ""; }

        foreach($this->information["other"] as $id => $info) {
            $totalSteps[] = ($this->hasPassed($info["position"]) ? $info["numberOfSteps"] : ""). ($info["metOnSameSpot"] ? "*" : "");;
        }
        return implode(",", $totalSteps);
    }

    private function nextStep() {
        foreach($this->information["other"] as $id => $info) {
            if(!$this->hasPassed($info["position"])) {
                $this->takeNextStep("other", $id);
            }
        }
        $this->takeNextStep("target");
        $this->onTheSameSpot();
    }

    private function takeNextStep(string $who, int $id = 0) {
        $currentPosition = $this->information[$who][$id]["position"];
        $this->information[$who][$id]["numberOfSteps"] += 1;

        if($this->path[$currentPosition] == $this->twostep && $this->information[$who][$id]["prevPosition"] != $currentPosition) {
            $this->information[$who][$id]["prevPosition"] = $currentPosition;
            return true;
        } elseif ($this->path[$currentPosition] == $this->switchWalkingDirection) {
            $this->removeSwitchWalkingDirectionFromPath($currentPosition);
            $this->information[$who][$id]["walkingDirection"] *= -1;
        }
        $this->information[$who][$id]["position"] += $this->information[$who][$id]["walkingDirection"];
    }

    private function onTheSameSpot() {
        foreach($this->information["other"] as $id => $info) {
            if($this->information["target"][0]["position"] == $info["position"]) {
                $this->information["other"][$id]["metOnSameSpot"] = true;
            }
        }
    }

    private function removeSwitchWalkingDirectionFromPath($position) {
        $this->path = substr_replace($this->path, ".", $position, 1);
        return true;
    }

    private function defineMax($maxPosition, $item) {
        if($item["walkingDirection"] < 0) {
            if($item['position'] > $maxPosition) {
                return $item["position"];
            }
        }
        return $maxPosition;
    }

    private function havePassedAll() {
        $callable = array($this, 'defineMax');
        return $this->information["target"][0]["position"] >= array_reduce($this->information["other"], $callable, 0);
    }

    private function hasPassed($position) {
        return $this->information["target"][0]["position"] >= $position;
    }
}