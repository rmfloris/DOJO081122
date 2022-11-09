<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Calculation\Calculation;

final class CalculationTest extends TestCase
{
    /**
     * @dataProvider sampleSetPhaseOne
     */
    public function testPhaseOneCalculationIsDoneCorrectly($input, $expected): void
    {
        $class = new Calculation($input);
        $this->assertSame($class->calculation(), $expected);
    }

    /**
     * @dataProvider sampleSetPhaseTwo
     */
    public function testPhaseTwoCalculationIsDoneCorrectly($input, $expected): void
    {
        $class = new Calculation($input);
        $this->assertSame($class->calculation(), $expected);
    }

    public function sampleSetPhaseOne(): array
    {
        return [
            ">.<"                           => [">.<", "1*"],
            ">..<"                          => [">..<", "2"],
            ">...<"                         => [">...<", "2*"],
            ">....<"                        => [">....<", "3"],
            ">.....<"                       => [">.....<", "3*"],
            ">.....................<"       => [">.....................<", "11*"],
            "...>...<.."                    => ["...>...<..", "2*"]
        ];
    }

    public function sampleSetPhaseTwo(): array
    {
        return [
            ">.+<"                          => [">.+<", "2*"]
        ];
    }
}
