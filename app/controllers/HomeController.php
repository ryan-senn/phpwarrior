<?php

use Services\Game\Position;
use Services\Game\Unit\Warrior;
use Services\Game\Unit\Ooze;
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
		require(storage_path() .'/Player.php');

		$map = new Map(5, 5);

		$position = new Position($map, 0, 0);
		$warrior = new Warrior($position);
		$map->setElement($warrior);

		$position = new Position($map, 2, 0);
		$ooze = new Ooze($position);
		$map->setElement($ooze);

		$map1 = clone $map;

		$player = new Player($warrior);

		for($i = 0; $i < 10; $i++)
		{
			$player->play_turn();
		}

		$map2 = clone $map;

		$this->layout->content = View::make('pages.home.mock', [
			'map1' => $map1,
			'map2' => $map2,
			'logs' => json_encode($warrior->getLog()),
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
		//return Response::json(json_encode($map));
	}
}

/*

<?php

class Player
{

	protected $warrior;


	public function __construct($warrior)
	{
		$this->warrior = $warrior;
	}
	

  	public function play_turn()
  	{
    	Log::info('played a turn');
    	$this->warrior->feel();
  	}
}

*/