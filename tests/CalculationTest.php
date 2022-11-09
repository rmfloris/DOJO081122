<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Calculation\Calculation;

final class CalculationTest extends TestCase
{
    /**
     * @dataProvider sampleSet
     */
    public function testCalculationIsDoneCorrectly($input, $expected): void
    {
        $class = new Calculation($input);
        $this->assertSame($class->calculation(), $expected);
    }

    public function sampleSet(): array
    {
        return [
            "...>..<..."    => ["...>..<...", "{2}"],
            ">.........<"   => [">.........<", "{5*}"],
            ">.<"           => [">.<", "{1*}"],
            ">..<"          => [">..<", "{2}"],
            ">...<"         => [">...<", "{2*}"],
            ">....<"        => [">....<", "{3}"]
        ];
    }
}