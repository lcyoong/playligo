<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollVotersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('poll_voters', function (Blueprint $table) {
            $table->increments('pov_id');
            $table->integer('pov_user')->unsigned();
            $table->integer('pov_poll')->unsigned();
            $table->integer('pov_poll_playlist')->unsigned();
            $table->timestamps();
            $table->foreign('pov_user')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('pov_poll')->references('pol_id')->on('polls')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('pov_poll_playlist')->references('polp_id')->on('poll_playlists')
                ->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('poll_voters');
    }
}
