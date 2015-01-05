<?php

// Composer: "fzaninotto/faker": "v1.3.0"
// use Faker\Factory as Faker;

class PlayersTableSeeder extends Seeder {

	public function run()
	{
		foreach(range(1, 9) as $index)
		{
			Player::create([]);
		}



	}

}