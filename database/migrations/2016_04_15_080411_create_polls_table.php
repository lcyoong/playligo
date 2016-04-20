<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polls', function (Blueprint $table) {
            $table->increments('pol_id');
            $table->integer('pol_user')->unsigned();
            $table->integer('pol_view')->unsigned()->default(0);
            $table->string('pol_title');
            $table->text('pol_description');
            $table->string('pol_status')->default('active');
            $table->timestamps();
            $table->foreign('pol_user')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('poll_playlists', function (Blueprint $table) {
            $table->increments('polp_id');
            $table->integer('polp_poll')->unsigned();
            $table->integer('polp_playlist')->unsigned();
            $table->string('polp_status')->default('active');
            $table->integer('polp_order')->default(0);
            $table->integer('polp_vote')->default(0);
            $table->timestamps();
            $table->foreign('polp_poll')->references('pol_id')->on('polls')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('polp_playlist')->references('pl_id')->on('playlists')
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
        Schema::drop('poll_playlists');
        Schema::drop('polls');
    }
}
