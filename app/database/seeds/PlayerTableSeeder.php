<?php

// Composer: "fzaninotto/faker": "v1.3.0"
// use Faker\Factory as Faker;

class PlayersTableSeeder extends Seeder {

	public function run()
	{
		for($i=1;$i<15;$i++)
		{
			Player::create(['user_id' => $i]);
		}

	}

}