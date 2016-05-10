<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('countries', function (Blueprint $table) {
          $table->string('coun_code');
          $table->string('coun_name');
          $table->string('coun_continent');
          $table->string('coun_region');
          $table->timestamps();
          $table->primary('coun_code');
      });

      Schema::create('cities', function (Blueprint $table) {
          $table->increments('cit_id');
          $table->string('cit_name');
          $table->integer('cit_hotels')->unsigned()->default(0);
          $table->string('cit_country');
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
        Schema::drop('cities');

        Schema::drop('countries');
    }
}
