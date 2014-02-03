<?php

use Services\Game\Map;
use Services\Game\Position;
use Services\Game\Units\Warrior;


class Skill
{

	public function setup()
	{
		$map = new Map(5, 5);
		$position = new Position($map, 0, 2);

		$this->warrior = new Warrior($position);
	}


	public function teardown()
	{
		$this->warrior = null;
	}
}