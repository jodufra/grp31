<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class TournamentHasPlayers extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tournament_have_players', function(Blueprint $table)
        {
            $table->integer('tournament_id')->unsigned();
            $table->integer('player_id')->unsigned();
            $table->integer('position')->unsigned()->default(0);
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('tournament_have_players');
    }

}