<?php


class HomeController extends BaseController
{

	protected $layout = 'layouts.base';


	public function index()
	{
		$this->layout->content = View::make('pages.home.index');
	}
}