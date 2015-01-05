<?php

// Composer: "fzaninotto/faker": "v1.3.0"
use Faker\Factory as Faker;

class FriendsTableSeeder extends Seeder {

	public function run()
	{
		DB::table('friends')->truncate();
		$friends = [];
		for($i=5;$i<15;$i++)
		{
			for($j = 5;$j<15;$j++)
			{
				if($j != $i)
				{
				array_push($friends, [
					'user_id' => $i,
				'friend_id' => $j

			]);
				}
			}
		}


		foreach($friends as $friend){
			User::create($friend);
		}
	}

}