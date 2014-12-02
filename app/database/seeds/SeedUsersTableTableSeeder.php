<?php



class SeedUsersTableTableSeeder extends Seeder {

	public function run()
	{
        DB::table('users')->truncate();

        $users = [
            [
                'first_name' => 'Super',
                'last_name' => 'Admin',
                'username' => 'sadmin',
                'email' => 'sadmin@example.com',
                'password' => Hash::make('sadmin'),
                'role' => 0
            ],
            [
                'first_name' => 'Normal',
                'last_name' => 'Admin',
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin'),
                'role' => 1
            ],
            [
                'first_name' => 'Super',
                'last_name' => 'User',
                'username' => 'suser',
                'email' => 'suser@example.com',
                'password' => Hash::make('suser'),
                'role' => 2
            ],
            [
                'first_name' => 'Normal',
                'last_name' => 'User',
                'username' => 'user',
                'email' => 'user@example.com',
                'password' => Hash::make('user'),
                'role' => 3
            ],
            [
                'first_name' => 'EmailNotVerified',
                'last_name' => 'User',
                'username' => 'euser',
                'email' => 'euser@example.com',
                'password' => Hash::make('euser'),
                'role' => 10
            ],
            [
                'first_name' => 'Banned',
                'last_name' => 'User',
                'username' => 'buser',
                'email' => 'buser@example.com',
                'password' => Hash::make('buser'),
                'role' => 11
            ],
        ];
        for($i=0;$i<10;$i++)
        {
            array_push($users, [
                'first_name' => 'Dummy',
                'last_name' => 'Player '.$i,
                'username' => 'player'.$i,
                'email' => 'player'.$i.'@example.com',
                'password' => Hash::make('player'.$i),
                'role' => 3
            ]);
        }

        foreach($users as $user){
            User::create($user);
        }

	}

}