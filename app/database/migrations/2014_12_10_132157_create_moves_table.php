<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMovesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('moves', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('game_id')->unsigned();
			$table->integer('player_id')->unsigned();
			$table->decimal('diceshand',5,0)->nullable();
			$table->decimal('dicessaved',5,0)->nullable();
			$table->tinyInteger('s_ones')->unsigned()->nullable();
			$table->tinyInteger('s_twos')->unsigned()->nullable();
			$table->tinyInteger('s_threes')->unsigned()->nullable();
			$table->tinyInteger('s_fours')->unsigned()->nullable();
			$table->tinyInteger('s_fives')->unsigned()->nullable();
			$table->tinyInteger('s_sixes')->unsigned()->nullable();
			$table->tinyInteger('s_bonus')->unsigned()->nullable();
			$table->tinyInteger('s_threekind')->unsigned()->nullable();
			$table->tinyInteger('s_fourkind')->unsigned()->nullable();
			$table->tinyInteger('s_house')->unsigned()->nullable();
			$table->tinyInteger('s_small_s')->unsigned()->nullable();
			$table->tinyInteger('s_large_s')->unsigned()->nullable();
			$table->tinyInteger('s_chance')->unsigned()->nullable();
			$table->tinyInteger('s_yahtzee')->unsigned()->nullable();
			$table->enum('choice', Move::$move_types)->nullable();

		});
	}
	
	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('moves');
	}

}
