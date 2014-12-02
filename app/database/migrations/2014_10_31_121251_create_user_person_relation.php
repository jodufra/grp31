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
        Schema::table('users', function ($table) {
            $table->foreign('person_idperson')->references('idperson')->on('people')
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
        Schema::table('users', function ($table) {
           $table->dropForeign('users_person_idperson_foreign');
        });
    }

}
