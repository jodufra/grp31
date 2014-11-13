<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserPersonRelation extends Migration
{
    /**
	 * Run the migrations.
	 *
	 * @return void
	 */
    public function up()
    {
        Schema::table('persons', function ($table) {
            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
        });
    }


    /**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
    public function down()
    {
        Schema::table('persons', function ($table) {
           $table->dropForeign('persons_user_id_foreign');
        });
    }

}
