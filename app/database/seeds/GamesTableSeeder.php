<?php

// Composer: "fzaninotto/faker": "v1.3.0"
//use Faker\Factory as Faker;

class GamesTableSeeder extends Seeder {

	public function run()
	{
		$faker = Faker::create();

		foreach(range(1, 10) as $index)
		{
			Game::create([
				'name' => 'semi',
				'winner' => '1',
				'finished_at' => date("Y-m-d", strtotime('2015-5-12'))
			]);
		}
	}

}