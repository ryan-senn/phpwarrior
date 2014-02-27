<?php

use Services\Game\Units\Warrior as BaseWarrior;

class Warrior extends BaseWarrior
{

    public function playTurn()
    {
        $this->walk($direction);
    }
}