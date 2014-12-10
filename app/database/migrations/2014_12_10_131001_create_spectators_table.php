<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSpectatorsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('spectators', function(Blueprint $table)
		{
			$table->increments('id');
			$table->foreign('game_id')->references('id')->on('games');
			$table->foreign('player_id')->references('id')->on('players')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('spectators', function ($table) {
           $table->dropForeign('spectators_game_id_foreign');
           $table->dropForeign('spectators_player_id_foreign');
        });
		Schema::drop('spectators');
	}

}
