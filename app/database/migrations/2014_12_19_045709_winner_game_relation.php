<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class WinnerGameRelation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('games', function (Blueprint $table) {
			$table->foreign('winner')->references('id')->on('players')->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('games', function (Blueprint $table) {
           $table->dropForeign('games_winner_foreign');
        });
	}

}
