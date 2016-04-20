<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlists', function (Blueprint $table) {
            $table->increments('pl_id');
            $table->integer('pl_user')->unsigned();
            $table->string('pl_title');
            $table->integer('pl_view')->unsigned()->default(0);
            $table->string('pl_description');
            $table->string('pl_status');
            $table->timestamps();
            $table->foreign('pl_user')->references('id')->on('users')
                ->onUpdate('cascade')->onDelete('cascade');
        });

        Schema::create('playlist_videos', function (Blueprint $table) {
            $table->increments('plv_id');
            $table->integer('plv_playlist')->unsigned();
            $table->string('plv_video_id');
            $table->string('plv_status');
            $table->integer('plv_order')->default(0);
            $table->timestamps();
            $table->foreign('plv_playlist')->references('pl_id')->on('playlists')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('plv_video_id')->references('vc_id')->on('video_caches')
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
        Schema::drop('playlist_videos');
        Schema::drop('playlists');
    }
}
