<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Calculation\Calculation3;

final class CalculationPhaseOneTest extends TestCase
{
    /**
     * @dataProvider sampleSet
     */
    public function testCalculationIsDoneCorrectly($input, $expected): void
    {
        $class = new Calculation3($input);
        $this->assertSame($expected, $class->calculation());
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
