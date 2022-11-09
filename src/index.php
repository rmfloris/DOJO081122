<?php
include_once("autoload.php");

use Calculation\Calculation;

$paths = array(
    "...>..<...",
    ">.........<",
    ">.<",
    ">..<",
    ">...<",
    ">....<"
);

foreach($paths as $path) {
    $numberOfSteps = (new Calculation($path))->calculation();
    echo "- path: <pre>". $path ."</pre> has as result: ". $numberOfSteps ."<br>";    
}
// $calculation = new Calculation("..>..<");
// $numberOfSteps = $calculation->calculation();

// echo "Number of Steps: ". $numberOfSteps;