<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserPlayerRelation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('players', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->nullable();
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
        Schema::table('players', function (Blueprint $table) {
           $table->dropForeign('players_user_id_foreign');
        });
	}

}
