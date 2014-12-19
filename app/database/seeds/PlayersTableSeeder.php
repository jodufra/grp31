<?php

// Composer: "fzaninotto/faker": "v1.3.0"
// use Faker\Factory as Faker;

class PlayersTableSeeder extends Seeder {

	public function run()
	{
		// $faker = Faker::create();

		// Criar os 9 bots
		foreach(range(0, 9) as $index)
		{
			Player::create([]);
		}


	}

}