<?php

namespace App\Utils\Benchmark\Outputs;

use App\Constants\Configs;
use App\Utils\Benchmark\Interfaces\Handable;

class LogHandler implements Handable
{
    public function __construct(
        private string $class, 
        private float $averageResult, 
        private float $averageTime, 
        private int $bestResult
    ){}

    public function handle(): void
    {
        var_dump(sprintf(
            "[%s] Average solution value: %.2f. Best solution: %d. Average execution time: %.4f",
            $this->class,
            $this->averageResult,
            $this->bestResult,
            $this->averageTime,
        ));
    }
}
