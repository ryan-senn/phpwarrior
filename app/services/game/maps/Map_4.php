<?php namespace Services\Game\Maps;

use Services\Game\Maps\Base as BaseMap;
use Services\Game\Map;
use Services\Game\Position;
use Services\Game\Units\Ooze;
use Services\Game\Items\Potion;


class Map_4 extends BaseMap
{

	protected $description = 'The air is thick and it smells bad... There must be a lot of these Oozes around.<br /><br />If your health drops too low, you can take a sip from your potion like so <code>$this->drink()</code> to regenerate 3 life. Your potion has only 3 charges, use them wisely.';

	protected $skills = ['feel', 'walk', 'attack', 'drink'];


	public function get()
	{
		require(storage_path() .'/Player.php');

		$map = new Map(5, 5);
		$map->placeStairs(4, 0);

		$position = new Position($map, 1, 4);
		$warrior = new \Warrior($position);
		$warrior->setSkills($this->skills);
		$warrior->setPotion(new Potion(3, 3));
		$map->addUnit($warrior);

		$position = new Position($map, 2, 2);
		$ooze = new Ooze($position);
		$map->addUnit($ooze);

		$position = new Position($map, 4, 3);
		$ooze = new Ooze($position);
		$map->addUnit($ooze);

		$position = new Position($map, 3, 0);
		$ooze = new Ooze($position);
		$map->addUnit($ooze);

		return $map;
	}
}