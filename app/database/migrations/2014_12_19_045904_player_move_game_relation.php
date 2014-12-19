<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PlayerMoveGameRelation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('moves', function (Blueprint $table) {
			$table->foreign('game_id')->references('id')->on('games');
			$table->foreign('player_id')->references('id')->on('players');
		});
		DB::statement('ALTER TABLE  `moves` DROP PRIMARY KEY , ADD PRIMARY KEY (  `id` ,  `game_id` ) ;');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('moves', function (Blueprint $table) {
			$table->dropForeign('moves_game_id_foreign');
			$table->dropForeign('moves_player_id_foreign');
		});
	}

}
