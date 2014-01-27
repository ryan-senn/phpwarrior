<?php namespace Services\Game\Units;

use Services\Game\Position;
use Services\Game\Events;
use Services\Game\Event;


abstract class Unit
{
	
	protected $health = 1;
	protected $attack = 1;

	protected $position;

	protected $skills = ['attack'];


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


	public function __call($method, $arguments)
	{
		if(!in_array($method, $this->getSkills()))
		{
			throw new \Exception('Unit '. static::NAME .' doesnt have skill '. $method);
		}

		$name = 'Services\Game\Skills\\'. ucfirst($method);
		$skill = new $name($this);

		$arguments = implode(',', $arguments);

		if($arguments != '')
		{
			$skill->execute($arguments);
		}
		else
		{
			$skill->execute();
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


	public function feel($direction = 'forward')
	{
		// only log warriors senses
		if($this->isWarrior())
		{
			$this->addEvent('feels '. $direction);
		}

		return $this->getSpace($direction);
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


    public function getUnit($direction, $forward = 1, $right = 0)
    {
    	return $this->getSpace($direction, $forward, $right)->getUnit();
    }


	public function getSpace($direction, $forward = 1, $right = 0)
	{
		$offset = $this->getOffset($direction, $forward, $right);

		return $this->position->getRelativeSpace($offset['x'], $offset['y']);
	}


	public function getOffset($direction, $forward = 1, $right = 0)
	{
		switch($direction)
		{
			case 'forward':
				return ['x' => $forward, 'y' => -$right];
				break;
			case 'backward':
				return ['x' => -$forward, 'y' => $right];
				break;
			case 'right':
				return ['x' => $right, 'y' => $forward];
				break;
			case 'left':
				return ['x' => -$right, 'y' => -$forward];
				break;
		}
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