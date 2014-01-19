<?php namespace Services\Game\Unit;

use Services\Game\Element;
use Services\Game\Location;


abstract class Unit extends Element
{
	
	protected $health = 20;
	protected $attack = 1;

	protected $log = [];

	protected $location;
	protected $direction = 'east';


	public function __construct(Location $location)
	{
		$this->location = $location;
	}


	public function attack()
	{

	}


	protected function loseHealth($number)
	{
		$this->health -= $number;
	}


	protected function gainHealth($number)
	{
		$this->health += $number;
	}


	protected function addLog($message)
	{
		$this->log[] = $message;
	}


	public function getLog()
	{
		return $this->log;
	}


	public function setDirection($direction)
	{
		$this->direction = $direction;
	}
}