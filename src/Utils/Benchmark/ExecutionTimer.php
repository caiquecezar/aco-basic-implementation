<?php

namespace App\Utils\Benchmark;

use App\Constants\Configs;
use App\Utils\Benchmark\Interfaces\Executable;
use App\Utils\Benchmark\Outputs\LogHandler;

class ExecutionTimer
{
    private array $configs;

    public function __construct(array $configs)
    {
        $this->configs = $configs;

        $this->configs[Configs::EXECUTION_TIMES] = 1;
        if (array_key_exists(Configs::EXECUTION_TIMES, $configs) && $configs[Configs::EXECUTION_TIMES] > 0) {
            $this->configs[Configs::EXECUTION_TIMES] = $configs[Configs::EXECUTION_TIMES];
        }
    }

    public function executeAndTime(Executable $object)
    {
        $classNamespace = $object::class;
        $splitedNamespace = explode('\\', $classNamespace);
        $class = $splitedNamespace[count($splitedNamespace) - 1];
        $timesToExecute = $this->configs[Configs::EXECUTION_TIMES];
        $bestResult = PHP_FLOAT_MIN;
        $totalTime = 0.0;
        $totalResult = 0.0;
        for ($i = 0; $i < $timesToExecute; $i++) {
            $startTime = microtime(true);

            $result = $object->execute();

            $endTime = microtime(true);
            $executionTime = $endTime - $startTime;

            $totalTime += $executionTime;
            $totalResult += $result;

            if ($result >= $bestResult) {
                $bestResult = $result;
            }
        }

        $averageTime = $totalTime / $timesToExecute;
        $averageResult = $totalResult / $timesToExecute;

        return new ExecutionResult($class, $averageResult, $averageTime, $bestResult);
    }

    public function withExcutionTimes(int $times): ExecutionTimer
    {
        $configs = $this->configs;
        $configs[Configs::EXECUTION_TIMES] = $times;

        return new ExecutionTimer($configs);
    }
}
