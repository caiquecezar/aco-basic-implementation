<?php

namespace App\Models;

class Player
{
    private string $name;
    private int $level;
    private int $experience;
    private string $class;

    public function __construct(string $name, int $level, int $experience, string $class) {
        $this->name = $name;
        $this->level = $level;
        $this->experience = $experience;
        $this->class = $class;
    }

    public function setName(string $name): Player {
        $this->name = $name;

        return $this;
    }

    public function setLevel(int $level): Player {
        $this->level = $level;

        return $this;
    }

    public function setExperience(int $experience): Player {
        $this->experience = $experience;

        return $this;
    }

    public function setClass(): string {
        return $this->class;
    }

    public function getName(): int {
        return $this->name;
    }

    public function getLevel(): int {
        return $this->level;
    }

    public function getExperience(): int {
        return $this->experience;
    }

    public function getClass(): int {
        return $this->class;
    }
}
