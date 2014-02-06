<?php namespace Services\Game\Maps;

use Services\Game\Maps\Map as BaseMap;
use Services\Game\Map;
use Services\Game\Position;


class map_1 extends BaseMap
{

	protected $description = 'Make your way to the stairs using your skills. There are helpers provided to... help.';

	protected $skills = ['walk'];

	protected $helpers = [
		'$this->position->getRelativeDirectionOfStairs();',
	];


	public function get()
	{
		require(storage_path() .'/Player.php');

		$map = new Map(5, 5);
		$map->placeStairs(3, 3);

		$position = new Position($map, 1, 0);
		$warrior = new \Warrior($position);
		$warrior->setSkills($this->skills);
		$map->addUnit($warrior);

		return $map;
	}
}