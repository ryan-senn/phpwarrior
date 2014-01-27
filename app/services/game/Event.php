<?php namespace Services\Game;

use Services\Game\Units\Unit;


class Event
{

	protected $unit;
	protected $message;


	public function setMessage($message)
	{
		$this->message = $message;
	}


	public function setUnit(Unit $unit)
	{
		$this->unit = $unit;
	}


	public function __toString()
	{
		return $this->unit .' '. $this->message;
	}
}