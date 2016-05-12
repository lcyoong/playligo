<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRatingTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('playlist_ratings', function (Blueprint $table) {
          $table->increments('plr_id');
          $table->integer('plr_playlist')->unsigned();
          $table->integer('plr_user')->unsigned();
          $table->decimal('plr_rating', 3, 1)->default(0);
          $table->string('plr_status')->default('active');
          $table->timestamps();
          $table->foreign('plr_playlist')->references('pl_id')->on('playlists')
              ->onUpdate('cascade')->onDelete('cascade');
          $table->foreign('plr_user')->references('id')->on('users')
              ->onUpdate('cascade')->onDelete('cascade');
      });

      Schema::create('poll_ratings', function (Blueprint $table) {
          $table->increments('polr_id');
          $table->integer('polr_poll')->unsigned();
          $table->integer('polr_user')->unsigned();
          $table->decimal('polr_rating', 3, 1)->default(0);
          $table->string('polr_status')->default('active');
          $table->timestamps();
          $table->foreign('polr_poll')->references('pol_id')->on('polls')
              ->onUpdate('cascade')->onDelete('cascade');
          $table->foreign('polr_user')->references('id')->on('users')
              ->onUpdate('cascade')->onDelete('cascade');
      });

      Schema::table('playlists', function ($table) {
        $table->decimal('pl_rating', 3, 1)->default(0);
        $table->integer('pl_rating_count')->unsigned()->default(0);
      });

      Schema::table('polls', function ($table) {
        $table->decimal('pol_rating', 3, 1)->default(0);
        $table->integer('pol_rating_count')->unsigned()->default(0);
      });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('playlist_ratings');

        Schema::drop('poll_ratings');

        Schema::table('playlists', function($table)
    		{
    		    $table->dropColumn('pl_rating');
    		});

        Schema::table('polls', function($table)
    		{
    		    $table->dropColumn('pol_rating');
    		});

    }
}
