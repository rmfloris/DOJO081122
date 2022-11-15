<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
use Calculation\Calculation4;

final class CalculationPhaseFourTest extends TestCase
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
            ">...@..<"  => [">...@..<", ""],
            ">...@..<..<"   => [">...@..<..<", ",5*"],
            ">..@.<"  => [">..@.<", ""], 
            ">..@+<" => [">..@+<", "3*"],
            ".@..>+@.<" => [".@..>+@.<", ""], 
            "..@>..++<" => ["..@>..++<", "3*"],
            "..@>.@++<" => ["..@>.@++<", "7"],
            ".@.>..+@+++<" => [".@.>..+@+++<", "13"],
            ">..+@<..+@..<+.@<@" => [">..+@<..+@..<+.@<@.", ",,12"], 
            ">+.@<.@++<@<....@." => [">+.@<.@++<@<....@.", "6,6*,"],
            // ".@>..<@." => [".@>..<@.", "2,6"]
            ".@>..<@." => [".@>..<@.", "2"]
        ];
    }
}
