<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLogEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('log_emails', function (Blueprint $table) {
            $table->increments('loem_id');
            $table->string('loem_type')->nullable();
            $table->string('loem_email');
            $table->string('loem_title');
            $table->text('loem_content');
            $table->datetime('loem_dt_sent')->default(0);
            $table->string('loem_status');
            $table->integer('loem_priority')->default(1);
            $table->string('loem_recipient_name');
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
        Schema::drop('log_emails');
    }
}
