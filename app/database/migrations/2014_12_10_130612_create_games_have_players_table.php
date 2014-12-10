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
			$table->foreign('game_id')->references('id')->on('games');
			$table->foreign('player_id')->references('id')->on('players');
			$table->increments('player_num');
		});
        Schema::table('games_have_players', function ($table) {
           $table->dropPrimary('games_have_players_player_num_primary');
           $table->primary(array('player_num', 'game_id', 'player_id'));
        });
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('games_have_players', function ($table) {
           $table->dropForeign('games_have_players_game_id_foreign');
           $table->dropForeign('games_have_players_player_id_foreign');
        });
		Schema::drop('games_have_players');
	}

}
