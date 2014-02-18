<?php namespace Services\Game\Maps;

use Services\Game\Maps\Map as BaseMap;
use Services\Game\Map;
use Services\Game\Position;
use Services\Game\Units\Ooze;


class map_2 extends BaseMap
{

	protected $skills = ['feel', 'walk', 'attack'];

	protected $helpers = [
		'$this->position->getRelativeDirectionOfStairs();',
	];


	public function get()
	{
		require(storage_path() .'/Player.php');

		$map = new Map(5, 5);
		$map->placeStairs(1, 4);

		$position = new Position($map, 4, 0);
		$warrior = new \Warrior($position);
		$warrior->setSkills($this->skills);
		$map->addUnit($warrior);

		$position = new Position($map, 2, 4);
		$ooze = new Ooze($position);
		$map->addUnit($ooze);

		return $map;
	}
}