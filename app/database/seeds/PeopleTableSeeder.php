<?php

// Composer: "fzaninotto/faker": "v1.3.0"
//use Faker\Factory as Faker;

class PeopleTableSeeder extends Seeder {

	public function run()
	{
		DB::table('people')->truncate();
		$people = [];
		for($i=1;$i<15;$i++)
		{
			array_push($people, [
				'name' => 'player',
				'photo' => '/img/default.png',
				'birthdate' => date("Y-m-d", strtotime('2015-5-12')),
				'country' => 'Afghanistan',
				'address' => 'Fake Street 123',
				'phone' => 912332323,
				'facebook_url' => 'http://fake123.com',
				'twitter_url' => 'http://fake321.com',
				'credit_card_titular' => 'Fake Person',
				'credit_card_num' => 111111111111111,
				'credit_card_valid' =>  date("Y-m-d", strtotime('2015-5-12'))

			]);
		}
		foreach($people as $person){
			Person::create($person);
		}



	}

}