<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('PlayersTableSeeder');
		$this->call('UsersTableSeeder');
//		$this->call('PeopleTableSeeder');
//		$this->call('FriendsTableSeeder');
//		$this->call('GamesTableSeeder');
	}

}
