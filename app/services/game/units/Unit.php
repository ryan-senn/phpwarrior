<?php namespace Services\Game\Units;

use Services\Game\Position;
use Services\Game\Events;
use Services\Game\Event;
use Services\Game\Skills\InvalidSkillException;


abstract class Unit
{
	
	protected $health = 1;
	protected $attack = 1;

	protected $position;

	protected $skills = [];

	protected $usedAction = false;


	public function __construct(Position $position)
	{
		$this->position = $position;
	}


	public function setSkills(array $skills)
	{
		$this->skills = $skills;
	}


	public function getSkills()
	{
		return $this->skills;
	}


	public function endTurn()
	{
		$this->usedAction = false;
	}


	public function __call($method, $arguments)
	{
		// make sure the skill actually exists
		if(!in_array($method, $this->getSkills()))
		{
			throw new InvalidSkillException('Unit '. static::NAME .' doesnt have skill '. $method);
		}

		$name = 'Services\Game\Skills\\'. ucfirst($method);
		$skill = new $name($this);

		// if the skill is an action, set flag to true so no more actions can be performed this turn
		if($skill->isAction())
		{
			// can only use one action per turn
			if($this->usedAction)
			{
				$this->addEvent('already used a skill this turn and can\'t '. $method);
				return;
			}

			$this->usedAction = true;
		}

		// only pass arguments to the skill if required
		$arguments = implode(',', $arguments);

		if($arguments != '')
		{
			return $skill->execute($arguments);
		}
		else
		{
			return $skill->execute();
		}
	}


	public function getX()
	{
		return $this->position->getX();
	}


	public function getY()
	{
		return $this->position->getY();
	}


	public function setPosition(Position $position = null)
	{
		$this->position = $position;
	}


	public function getPosition()
	{
		return $this->position;
	}


	public function getHealth()
	{
		return $this->health;
	}


	public function isWarrior()
	{
		return $this::NAME == 'Warrior';
	}


	public function damage(Unit $receiver)
	{
		$receiver->loseHealth($this->attack);

		$this->addEvent('attacks '. $receiver::NAME .', causing '. $this->attack .' damage. '. $receiver::NAME .' is down to '. $receiver->health .' health');
	}


	public function loseHealth($amount)
	{
		$this->health -= $amount;
	}


	public function gainHealth($amount)
	{
		$this->health += $amount;
	}


	public function isAlive()
	{
		return $this->health > 0;
	}


    public function getUnit($direction)
    {
    	return $this->getSpace($direction)->getUnit();
    }


	public function getSpace($direction)
	{
		return $this->position->getRelativeSpace($direction);
	}


	public function addEvent($message)
	{
		$event = new Event;
		$event->setUnit($this);
		$event->setMessage($message);

		Events::add($event);
	}


	public function __toString()
	{
		return static::NAME;
	}
}