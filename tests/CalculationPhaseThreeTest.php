<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Calculation\Calculation3;

final class CalculationPhaseThreeTest extends TestCase
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
            ">..<...<"  => [">..<...<", "2,4"],
            ">.<...<"   => [">.<...<", "1*,3*"],
            ">.<....<"  => [">.<....<", "1*,4"],
            ">..+<.<++<" => [">..+<.<++<", "3,3*,6*"],
            "...++>..++...<.<+<.." => ["...++>..++...<.<+<..", "5*,6*,8"]            
        ];
    }
}
