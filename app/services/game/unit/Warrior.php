<?php namespace Services\Game\Unit;

class Warrior extends Unit
{
	

	public function feel($direction = 'forward')
	{
		$this->log('warrior feels '. $direction);

		return new Space($this->location, $direction);
	}


	public function walk($direction = 'forward')
	{
		$this->log('warrior walks '. $direction);

		$this->location->move($direction);
	}


	public function rest()
	{
		$this->log('warrior rests');

		$this->gainHealth(2);
	}
}