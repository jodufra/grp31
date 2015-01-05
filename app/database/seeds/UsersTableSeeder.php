<?php



class UsersTableSeeder extends Seeder {

	public function run()
	{
        DB::table('users')->truncate();

        $users = [
            [
                'username' => 'sadmin',
                'email' => 'sadmin@example.com',
                'password' => Hash::make('sadmin'),
                'role' => 0
            ],
            [
                'username' => 'admin',
                'email' => 'admin@example.com',
                'password' => Hash::make('admin'),
                'role' => 1
            ],
            [
                'username' => 'suser',
                'email' => 'suser@example.com',
                'password' => Hash::make('suser'),
                'role' => 2
            ],


            [
                'username' => 'buser',
                'email' => 'buser@example.com',
                'password' => Hash::make('buser'),
                'role' => 11
            ],
        ];
        for($i=1;$i<=11;$i++)
        {
            array_push($users, [
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