<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlaylistKeysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('playlist_keys', function (Blueprint $table) {
            $table->increments('plk_id');
            $table->integer('plk_playlist')->unsigned();
            $table->string('plk_key');
            $table->decimal('plk_weight', 5, 2)->default(0);
            $table->string('plk_next_token');
            $table->timestamps();
            $table->foreign('plk_playlist')->references('pl_id')->on('playlists')
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
        Schema::drop('playlist_keys');
    }
}
