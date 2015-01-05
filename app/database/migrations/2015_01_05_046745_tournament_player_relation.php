<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TournamentPlayerRelation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tournament_have_players', function (Blueprint $table) {
			$table->foreign('tournament_id')->references('id')->on('tournaments');
			$table->foreign('player_id')->references('id')->on('players')->nullable();
		});
		//DB::statement('ALTER TABLE  `tournament_have_games` ADD PRIMARY KEY (  `tournament_id` ,  `game_id`  ) ;');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('tournament_have_players', function (Blueprint $table) {
			$table->dropForeign('tournament_have_tournaments_tournament_id_foreign');
			$table->dropForeign('tournament_have_players_player_id_foreign');
		});
	}

}
