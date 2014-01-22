<?php

use Services\Game\Position;
use Services\Game\Unit\Ooze;
use Services\Game\Unit\Unit;
use Services\Game\Map;


class HomeController extends BaseController
{

	protected $layout = 'layouts.base';


	public function index()
	{
		$this->layout->content = View::make('pages.home.index');
	}


	public function mock()
	{
		require(storage_path() .'/Warrior.php');

		$map = new Map(5, 5);
		$map->placeStairs(3, 2);

		$position = new Position($map, 2, 0);
		$warrior = new Warrior($position);
		$map->addUnit($warrior);

		$position = new Position($map, 2, 4);
		$ooze = new Ooze($position);
		$map->addUnit($ooze);
		
		$position = new Position($map, 2, 3);
		$ooze = new Ooze($position);
		$map->addUnit($ooze);
		
		$position = new Position($map, 2, 2);
		$ooze = new Ooze($position);
		$map->addUnit($ooze);

		for($turn = 0; $turn < 1000; $turn++)
		{
			if(!$warrior->isAlive())
			{
				$warrior::addLog('lost the game');
				break;
			}

			if($warrior->getPosition()->isAt($map->getStairsLocation()['x'], $map->getStairsLocation()['y']))
			{
				$warrior::addLog('won the game');
				break;
			}

			$maps[] = clone $map;

			foreach($map->getUnits() as $unit)
			{
				// play this units turn if it's not dead
				if(!is_null($unit->getPosition()))
				{
					$unit->playTurn();
				}
			}
		}

		$this->layout->content = View::make('pages.home.mock', [
			'maps' => $maps,
			'logs' => $warrior->getLogs(),
		]);
	}


	public function submit()
	{
		$code = Input::get('code');

		file_put_contents(storage_path() .'/Player.php', $code);
		require(storage_path() .'/Player.php');

		$map = new Map(5, 5);

		$position = new Position($map, 1, 2);
		$warrior = new Warrior($position);

		$map->setElement($warrior);

		$player = new Player($warrior);

		for($i = 0; $i < 10; $i++)
		{
			$player->play_turn();
		}

		return Response::json(json_encode($warrior->getLog()));
	}
}