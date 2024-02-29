<?php

namespace App\Aco;

use App\Models\Player as ModelsPlayer;
use CaiqueCezar\Aco\Components\Abstracts\Node;

class Player extends Node
{
    private ModelsPlayer $player;

    public function __construct(ModelsPlayer $player) {
        $this->player = $player;

        parent::__construct();
    }

    public function getLevel(): int {
        return $this->player->getLevel();
    }
}