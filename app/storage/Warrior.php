<?php

use Services\Game\Unit\Warrior as BaseWarrior;


class Warrior extends BaseWarrior
{

    public function playTurn()
    {
        $space = $this->feel();

        if($space->isEmpty())
        {
            $this->walk();
        }
        elseif($space->isEnnemy())
        {
            $this->attack();
        }
    }
}