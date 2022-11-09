<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Calculation\Calculation2;

final class CalculationPhaseOneTest extends TestCase
{
    /**
     * @dataProvider sampleSet
     */
    public function testCalculationIsDoneCorrectly($input, $expected): void
    {
        $class = new Calculation2($input);
        $this->assertSame($class->calculation(), $expected);
    }

    public function sampleSet(): array
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
}
