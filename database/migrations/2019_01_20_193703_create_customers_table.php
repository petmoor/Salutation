<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('salutation_id');
            $table->string('firstname', 64);
            $table->string('lastname', 64);
            $table->string('company', 64)->nullabel();
            $table->string('street', 64);
            $table->string('housenumber', 8);
            $table->string('city', 64);
            $table->string('zip', 5);
            $table->string('country_id', 64);
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
        Schema::dropIfExists('customers');
    }
}
