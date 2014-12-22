<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePeopleTable extends Migration
{
    /**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('name');
            $table->string('photo')->defaultValue('/img/default.png');
            $table->date('birthdate');
            $table->string('country');
            $table->text('address')->nullable();
            $table->decimal('phone', 9, 0)->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            //
            $table->string('credit_card_titular');
            $table->decimal('credit_card_num', 16, 0);
            $table->date('credit_card_valid');
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
        Schema::drop('people');
    }

}
