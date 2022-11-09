<?php
include_once("autoload.php");

use Calculation\Calculation2;

$path = ">.+<";

$calculation = new Calculation2($path);
$numberOfSteps = $calculation->calculation();
echo "- path: <code>". $path ."</code> has as result: ". $numberOfSteps ."<br>";    
echo "<pre>";
var_dump($calculation);