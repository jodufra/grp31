<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            //Account Info
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('role')->unsigned()->defaultValue(10);
            // role = 0 => SuperAdmin
            // role = 1 => Admin
            // role = 2 => SuperUser
            // role = 3 => NormalUser
            //role = 9 => banned User
            // role = 10 => EmailNotVerified
            $table->integer('gamesPlayed')->unsigned()->defaultValue(0);
            $table->integer('gamesWon')->unsigned()->defaultValue(0);
            $table->integer('gamesPlayed')->unsigned()->defaultValue(0);
            $table->integer('tournamentsParticipated')->unsigned()->defaultValue(0);
            $table->integer('tournamentsWonFistPlace')->unsigned()->defaultValue(0);
            $table->integer('tournamentWonSecPlace')->unsigned()->defaultValue(0);
            $table->integer('tournamentWonThirdPlace')->unsigned()->defaultValue(0);

            $table->string('remember_token')->nullable();
            $table->timestamps();
        });
    }

    /**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
    public function down()
    {
        Schema::drop('users');
    }

}
