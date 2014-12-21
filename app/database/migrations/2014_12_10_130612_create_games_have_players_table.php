<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateGamesHavePlayersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('games_have_players', function(Blueprint $table)
		{
			$table->integer('game_id')->unsigned();
			$table->integer('player_id')->unsigned();
			$table->integer('player_num')->unsigned();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('games_have_players');
	}

}
