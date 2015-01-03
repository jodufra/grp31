<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddUsersFriendsRelation extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('friends', function (Blueprint $table) {
			$table->foreign('user_id')->references('id')->on('users');
			$table->foreign('friend_id')->references('id')->on('users');
		});
		DB::statement('ALTER TABLE  `friends` ADD PRIMARY KEY (  `user_id` ,  `friend_id` ) ;');
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('friends', function(Blueprint $table)
		{
			$table->dropForeign('friends_user_id_foreign');
			$table->dropForeign('friends_friend_id_foreign');
		});
	}

}
