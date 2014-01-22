<?php

use Services\Game\Unit\Warrior as BaseWarrior;


class Warrior extends BaseWarrior
{


    public function playTurn()
    {
        $direction = $this->position->getRelativeDirectionOfStairs();

        $space = $this->feel($direction);
        
        if($space->isEmpty($direction))
        {
            if($this->health < 20)
            {
                $this->rest();
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