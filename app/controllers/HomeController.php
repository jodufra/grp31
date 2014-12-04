<?php
/**
 * Created by PhpStorm.
 * User: Schmeisk
 * Date: 31/10/2014
 * Time: 16:54
 */

class HomeController extends BaseController
{
	public function showHome()
	{
		return View::make('home');
	}
}
