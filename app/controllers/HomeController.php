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
		Notify::flashDanger("Your Message");
		Notify::flashSuccess("Your Message");
		Notify::flashWarning("Your Message");
		Notify::flashInfo("Your Message");
		return View::make('home');
	}
}
