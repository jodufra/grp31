<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TournamentGameRelation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('tournament_have_games', function (Blueprint $table) {
			$table->foreign('tournament_id')->references('id')->on('tournaments');
			$table->foreign('game_id')->references('id')->on('games')->nullable();
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
		Schema::table('tournament_have_games', function (Blueprint $table) {
			$table->dropForeign('tournament_have_games_tournament_id_foreign');
			$table->dropForeign('tournament_have_games_game_id_foreign');
		});
	}

}
