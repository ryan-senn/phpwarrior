<?php

use Services\Game\Location;
use Services\Game\Unit\Warrior;
use Services\Game\Map;


class HomeController extends BaseController
{

	protected $layout = 'layouts.base';


	public function index()
	{
		$this->layout->content = View::make('pages.home.index');
	}


	public function submit()
	{
		$code = Input::get('code');

		file_put_contents(storage_path() .'/Player.php', $code);
		require(storage_path() .'/Player.php');

		$location = new Location(1, 2);
		$warrior = new Warrior($location);

		$map = new Map(5, 5);
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