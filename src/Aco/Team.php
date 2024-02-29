<?php

namespace App\Aco;

use CaiqueCezar\Aco\Components\Abstracts\Solution;

class Team extends Solution
{
    public function calculateObjective(): float
    {
        $total = 0;
        foreach ($this->nodes as $node) {
            $total+=$node->getLevel();
        }

        return $total;
    }

    public function isValidSolution(): bool
    {
        return count($this->nodes) == 6;
    }
}
