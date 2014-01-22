<?php namespace Services\Game\Unit;

use Services\Game\Position;


abstract class Unit
{
	
	protected $health = 1;
	protected $attack = 1;

	protected $position;

	protected static $logs;


	public function __construct(Position $position)
	{
		$this->position = $position;
	}


	public function getX()
	{
		return $this->position->getX();
	}


	public function getHealth()
	{
		return $this->health;
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


	public function isWarrior()
	{
		return $this::NAME == 'Warrior';
	}


	public function feel($direction = 'forward')
	{
		// only log warriors senses
		if($this->isWarrior())
		{
			$this->addLog('feels '. $direction);
		}

		return $this->getSpace($direction);
	}


	public function attack($direction = 'forward')
	{
		$space = $this->getSpace($direction);

		if($space->isWall())
		{
			self::addLog('attacks and hits a wall');
		}
		elseif($receiver = $space->getUnit())
		{
			$this->damage($receiver);

			if(!$receiver->isAlive())
			{
				self::addLog('killed '. $receiver::NAME);

				$receiver->setPosition(null);
			}
		}
		else
		{
			self::addLog('attacks and hits nothing');
		}
	}


	protected function damage(Unit $receiver)
	{
		$receiver->loseHealth($this->attack);

		self::addLog('attacks '. $receiver::NAME .', causing '. $this->attack .' damage. '. $receiver::NAME .' is down to '. $receiver->health .' health');
	}


	protected function loseHealth($amount)
	{
		$this->health -= $amount;
	}


	protected function gainHealth($amount)
	{
		$this->health += $amount;
	}


	public function isAlive()
	{
		return $this->health > 0;
	}


    protected function getUnit($direction, $forward = 1, $right = 0)
    {
    	return $this->getSpace($direction, $forward, $right)->getUnit();
    }


	protected function getSpace($direction, $forward = 1, $right = 0)
	{
		$offset = $this->getOffset($direction, $forward, $right);

		return $this->position->getRelativeSpace($offset['x'], $offset['y']);
	}


	protected function getOffset($direction, $forward = 1, $right = 0)
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


	public static function addLog($message)
	{
		self::$logs[] = static::NAME .' '. $message;
	}


	public static function getLogs()
	{
		return self::$logs;
	}


	public function __toString()
	{
		return static::NAME;
	}
}