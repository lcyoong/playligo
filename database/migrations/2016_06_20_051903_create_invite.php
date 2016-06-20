<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvite extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('invites', function (Blueprint $table) {
          $table->string('inv_code', 50);
          $table->string('inv_description');
          $table->string('inv_status', 20)->default('active');
          $table->timestamps();
      });

      Schema::table('users', function ($table) {
        $table->string('invite_code')->nullable();
      });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::drop('invites');

      Schema::table('users', function($table)
  		{
		    $table->dropColumn('invite_code');
  		});
    }
}
