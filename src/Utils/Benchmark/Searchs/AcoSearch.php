<?php

namespace App\Utils\Benchmark\Searchs;

use App\Utils\Benchmark\Interfaces\CSVFieldAdder;
use App\Utils\Benchmark\Interfaces\Executable;
use CaiqueCezar\Aco\Components\AntColonyOptimization;

class AcoSearch implements Executable, CSVFieldAdder
{
    private AntColonyOptimization $aco;

    public function __construct(AntColonyOptimization $aco) {
        $this->aco = $aco;
    }

    public function execute(): float
    {
        $solution = $this->aco->run();
    
        return $solution->calculateObjective();
    }

    public function getAdditionalHeaders(): string
    {
        return "number of ants;pheromone initial;evaporation fee";
    }

    public function getAdditionalContent(): string
    {
        return "2000;10000;0.001";
    }

}
