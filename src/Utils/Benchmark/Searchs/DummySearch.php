<?php

namespace App\Utils\Benchmark\Searchs;

use App\Aco\Team;
use App\Utils\Benchmark\Interfaces\Executable;
use CaiqueCezar\Aco\Components\Factories\SolutionFactory;

class DummySearch implements Executable
{
    private array $players;

    public function __construct(array $players) {
        $this->players = $players;
    }

    public function execute(): float
    {
        $max = 0;
    
        for ($a = 0; $a < count($this->players); $a++) {
            for ($b = 0; $b < count($this->players); $b++) {
                if (in_array($b, [$a])) continue;
                for ($c = 0; $c < count($this->players); $c++) {
                    if (in_array($c, [$a,$b])) continue;
                    for ($d = 0; $d < count($this->players); $d++) {
                        if (in_array($d, [$a,$b,$c])) continue;
                        for ($e = 0; $e < count($this->players); $e++) {
                            if (in_array($e, [$a,$b,$c,$d])) continue;
                            for ($f = 0; $f < count($this->players); $f++) {
                                if (in_array($f, [$a,$b,$c,$d,$e])) continue;
                                $solution = SolutionFactory::createSolution(Team::class);
                                $solution
                                    ->addPartialSolution($this->players[$a])
                                    ->addPartialSolution($this->players[$b])
                                    ->addPartialSolution($this->players[$c])
                                    ->addPartialSolution($this->players[$d])
                                    ->addPartialSolution($this->players[$e])
                                    ->addPartialSolution($this->players[$f]);
                                
                                $total = $solution->calculateObjective();
        
                                if ($total > $max) {
                                    $max = $total;
                                }
                            }
                        }
                    }
                }
            }
        }

        return $max;
    }
}
