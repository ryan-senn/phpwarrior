<?php

use Services\Game\Position;
use Services\Game\Units\Ooze;


class AttackTest extends SkillTest
{

	public function testWarriorDoesDamage()
	{
		$this->warrior->setSkills(['attack']);
		
		$ooze = new Ooze(new Position($this->map, 1, 3));
		$this->map->addUnit($ooze);

		$this->warrior->attack();

		$this->assertEquals(7, $ooze->getHealth());
	}


	public function testWarriorAttacksWrongDirection()
	{
		$this->warrior->setSkills(['attack']);
		
		$ooze = new Ooze(new Position($this->map, 1, 3));

		// place ooze on the map
		$this->map->addUnit($ooze);

		$this->warrior->attack('left');

		$this->assertEquals(10, $ooze->getHealth());
	}


	public function testOozeDoesDamageToWarrior()
	{
		$ooze = new Ooze(new Position($this->map, 1, 3));

		// place warrior on the map
		$this->map->addUnit($this->warrior);

		$ooze->attack('backward');

		$this->assertEquals(17, $this->warrior->getHealth());
	}
}