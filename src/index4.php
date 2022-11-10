<?php
include_once("autoload.php");

use Calculation\Calculation4;

$path = ">...@..<..<";

$calculation = new Calculation4($path);
$numberOfSteps = $calculation->calculation();
echo "- path: <code>". $path ."</code> has as result: ". $numberOfSteps ."<br>";    
echo "<pre>";
var_dump($calculation);

