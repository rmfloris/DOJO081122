<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Calculation\Calculation4;

final class CalculationPhaseTwoTest extends TestCase
{
    /**
     * @dataProvider sampleSet
     */
    public function testCalculationIsDoneCorrectly($input, $expected): void
    {
        $class = new Calculation4($input);
        $this->assertSame($expected, $class->calculation());
    }

    public function sampleSet(): array
    {
        return [
            ">+<"                           => [">+<", "1*"],
            ">.+<"                           => [">.+<", "2*"],
            ">..+<"                          => [">..+<", "3"],
            ">+.<"                         => [">+.<", "2*"],
            ">..++<"                        => [">..++<", "3*"],
            ">.+.+.<"                       => [">.+.+.<", "4*"],
            ">+....<"       => [">+....<", "4"],
            ">++.++<"                    => [">++.++<", "5*"],
            ">+++<"                    => [">+++<", "3*"],
            ">.+..<"                    => [">.+..<", "3*"],
            ">....++<"                    => [">....++<", "5"]
        ];
    }
}
