<?php

namespace App\Models\Factories;

use App\Exceptions\InvalidPlayerQuantityException;
use App\Models\Player;
use Faker\Factory;

class PlayerFactory
{
    public static function create(int $quantity = 1): array {
        $faker = Factory::create();

        if ($quantity <= 0) {
            throw new InvalidPlayerQuantityException();
        }
    
        for ($i = 0; $i < $quantity; $i++) {
            $players[] = new Player(
                $faker->name(),
                $faker->numberBetween(1,20),
                $faker->numberBetween(1, 10000),
                $faker->randomElement(['A', 'B', 'C', 'D', 'E'])
            );
        }

        return $players;
    }
}
