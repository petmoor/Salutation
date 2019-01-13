<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirstnameweightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firstnameweights', function (Blueprint $table) {
            $table->increments('fncw_id');
            $table->integer('fn_id');
            $table->string('country_id', 2);
            $table->integer('weight');
            $table->timestamps();
            $table->index('fn_id');
            $table->index(['fn_id', 'country_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('firstnameweights');
    }
}
