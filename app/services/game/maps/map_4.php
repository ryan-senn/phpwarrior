<?php namespace Services\Game\Maps;

use Services\Game\Maps\Map as BaseMap;
use Services\Game\Map;
use Services\Game\Position;
use Services\Game\Units\Ooze;
use Services\Game\Items\Potion;


class map_4 extends BaseMap
{

	protected $skills = ['feel', 'walk', 'attack', 'drink'];
	
	protected $helpers = [
		'$this->position->getRelativeDirectionOfStairs()',
		'$this->potion->isEmpty()',
	];


	public function get()
	{
		require(storage_path() .'/Player.php');

		$map = new Map(5, 5);
		$map->placeStairs(0, 1);

		$position = new Position($map, 4, 3);
		$warrior = new \Warrior($position);
		$warrior->setSkills($this->skills);
		$warrior->setPotion(new Potion(5, 2));
		$map->addUnit($warrior);

		$position = new Position($map, 0, 3);
		$ooze = new Ooze($position);
		$map->addUnit($ooze);

		$position = new Position($map, 1, 2);
		$ooze = new Ooze($position);
		$map->addUnit($ooze);

		return $map;
	}
}