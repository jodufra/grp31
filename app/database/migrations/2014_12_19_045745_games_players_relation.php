<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class GamesPlayersRelation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('games_have_players', function (Blueprint $table) {
			$table->foreign('game_id')->references('id')->on('games');
			$table->foreign('player_id')->references('id')->on('players');
		});
		DB::statement('ALTER TABLE  `games_have_players` ADD PRIMARY KEY (  `player_num` ,  `game_id` ,  `player_id` ) ;');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('games_have_players', function (Blueprint $table) {
			$table->dropForeign('games_have_players_game_id_foreign');
			$table->dropForeign('games_have_players_player_id_foreign');
		});
	}

}
