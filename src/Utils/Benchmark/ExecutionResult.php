<?php

namespace App\Utils\Benchmark;

class ExecutionResult
{
    public function __construct(
        private string $class,
        private float $averageResult,
        private float $averageTime,
        private int $bestSolution
    ){}

    public function getClass(): string
    {
        return $this->class;
    }
    public function getAverageResult(): float
    {
        return $this->averageResult;
    }
    public function getAverageTime(): float
    {
        return $this->averageTime;
    }
    public function getBestSolution(): int
    {
        return $this->bestSolution;
    }
}
