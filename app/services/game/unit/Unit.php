<?php namespace Services\Game\Unit;

use Services\Game\Element;
use Services\Game\Position;


abstract class Unit extends Element
{
	
	protected $health = 20;
	protected $attack = 1;

	protected $log = [];

	protected $direction = 'east';


	public function attack()
	{
		$this->addLog('unit attacks');
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


	public function __toString()
	{
		return substr(strrchr(get_class($this), "\\"), 1);
	}
}