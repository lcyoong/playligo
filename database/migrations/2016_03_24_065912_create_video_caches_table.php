<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVideoCachesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('video_caches', function (Blueprint $table) {
            $table->string('vc_id');
            $table->string('vc_etag');
            $table->string('vc_kind');
            $table->text('vc_snippet');
            $table->primary('vc_id');
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
        Schema::drop('video_caches');
    }
}
