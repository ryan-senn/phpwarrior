<?php

use Services\Game\Units\Warrior as BaseWarrior;

class Warrior extends BaseWarrior
{

    public function playTurn()
    {
        $direction = $this->position->getRelativeDirectionOfStairs();
        
        $space = $this->feel($direction);
        
        if($space->isEmpty())
        {
            $this->walk($direction);
        }
        else
        {
            $this->attack($direction);
        }
    }
}