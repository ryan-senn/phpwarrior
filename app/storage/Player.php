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
            if($this->health < 20 && !$this->potion->isEmpty())
            {
                $this->drink();
            }
            else
            {
                $this->walk($direction);
            }
        }
        else
        {
            $this->attack($direction);
        }
    }
}