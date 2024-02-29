<?php

namespace App\Aco;

use CaiqueCezar\Aco\Components\Abstracts\Pheromone;

class Sinergy extends Pheromone
{
    public function calculatePheromoneIncreaseValue(float $objectiveReached): int
    {
        $initialEvaporation = $this->initialPheromone * $this->evaporationFee;

        $meanLevel = ($objectiveReached/6);

        $x = ($meanLevel-10);
        if ($x > 0) {
            $increase = $x*$initialEvaporation;
        } else {
            $increase = $initialEvaporation - ((-1*$x)/10 * $initialEvaporation);
        }

        return $increase;
    }
}
