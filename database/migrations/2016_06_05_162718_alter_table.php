<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::table('polls', function ($table) {
        $table->integer('pol_playlist_count')->default(0);
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('polls', function($table)
  		{
		    $table->dropColumn('pol_playlist_count');
  		});
    }
}
