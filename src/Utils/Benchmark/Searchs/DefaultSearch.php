<?php

namespace App\Utils\Benchmark\Searchs;

use App\Aco\Player;
use App\Aco\Team;
use App\Utils\Benchmark\Interfaces\Executable;
use CaiqueCezar\Aco\Components\Factories\SolutionFactory;

class DefaultSearch implements Executable
{
    private array $players;

    public function __construct($players) {
        $this->players = $players;
    }

    public function execute(): float
    {
        usort($this->players, function (Player $a, Player $b) {
            if ($a->getLevel() == $b->getLevel()) {
                return 0;
            }
            return ($a->getLevel() < $b->getLevel()) ? -1 : 1;
        });
    
        $solution = SolutionFactory::createSolution(Team::class);
        for ($i = count($this->players) - 1; $i > count($this->players) - 7; $i--) {
            $solution->addPartialSolution($this->players[$i]);
        }
    
        return $solution->calculateObjective();
    }
}
