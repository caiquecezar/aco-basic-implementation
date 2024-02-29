<?php

namespace App\Utils\Benchmark;

use App\Constants\Configs;
use App\Utils\Benchmark\Interfaces\Executable;
use App\Utils\Benchmark\Outputs\LogHandler;
use App\Utils\Benchmark\Outputs\CsvHandler;

class Benchmark
{
    private ExecutionTimer $executer;
    private array $configs;

    public function __construct(array $configs)
    {
        $this->configs = $configs;

        $this->configs[Configs::EXECUTION_TIMES] = 1;
        if (array_key_exists(Configs::EXECUTION_TIMES, $configs) && $configs[Configs::EXECUTION_TIMES] > 0) {
            $this->configs[Configs::EXECUTION_TIMES] = $configs[Configs::EXECUTION_TIMES];
        }

        $this->executer = new ExecutionTimer($configs);
    }

    public function run(Executable $object)
    {
        $results = $this->executer->executeAndTime($object);

        if ($this->configs[Configs::OUTPUT] == Configs::OUTPUT_LOG) {
            $logHandler = new LogHandler(
                $results->getClass(),
                $results->getAverageResult(),
                $results->getAverageTime(),
                $results->getBestSolution()
            );

            $logHandler->handle();
        }

        if ($this->configs[Configs::OUTPUT] == Configs::OUTPUT_FILE) {
            if (array_key_exists(Configs::OUTPUT_FILE_TYPE, $this->configs) && array_key_exists(Configs::OUTPUT_FILE_TYPE, $this->configs) == Configs::OUTPUT_FILE_TYPE_CSV) {
                $csvHandler = new CsvHandler(
                    $results->getClass(),
                    $results->getAverageResult(),
                    $results->getAverageTime(),
                    $results->getBestSolution(),
                    $object
                );

                $csvHandler->handle();
            }
        }

        return $results->getBestSolution();
    }

    public function withExcutionTimes(int $times): Benchmark
    {
        $configs = $this->configs;
        $configs[Configs::EXECUTION_TIMES] = $times;

        return new Benchmark($configs);
    }


}
