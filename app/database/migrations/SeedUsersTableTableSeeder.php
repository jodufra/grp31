<?php



class SeedUsersTableTableSeeder extends Seeder {

	public function run()
	{
        DB::table('users')->truncate();

        $users = [
            [
                'first_name' => 'Elias',
                'last_name' => 'Pinheiro',
                'username' => 'admin',
                'email' => 'schmeisk@gmail.com',
                'password' => Hash::make('admin')
            ],
            [
                'first_name' => 'Player',
                'last_name' => 'A',
                'username' => 'playera',
                'email' => 'playera@gmail.com',
                'password' => Hash::make('12345')
            ],
        ];
        for($i=0;$i<10;$i++)
        {
            array_push($users, [
                'first_name' => 'Player',
                'last_name' => $i,
                'username' => 'player'.$i,
                'email' => 'schmeisk@gmail.com',
                'password' => Hash::make('12345')
            ]);
        }

        foreach($users as $user){
            User::create($user);
        }

	}

}