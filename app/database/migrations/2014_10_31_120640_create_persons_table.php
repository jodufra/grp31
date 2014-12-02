<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersonsTable extends Migration
{
    /**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::create('persons', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('photo_url')->nullable();
            $table->string('first_name');
            $table->string('last_name');
            $table->date('birth_date');
            $table->string('country');
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->decimal('phone_number', 9, 0)->nullable();
            $table->string('facebook_url')->nullable();
            $table->string('twitter_url')->nullable();
            //
            $table->string('credit_card_type');
            $table->string('credit_card_titular');
            $table->decimal('credit_card_num', 16, 0);
            $table->integer('credit_card_valid_month')->unsigned();
            $table->integer('credit_card_valid_year')->unsigned();
            $table->integer('credit_card_valid_cvc')->unsigned();
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
        Schema::drop('persons');
    }

}
