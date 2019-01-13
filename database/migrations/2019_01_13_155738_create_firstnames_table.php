<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirstnamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firstnames', function (Blueprint $table) {
            $table->increments('fn_id');
            $table->string ('firstname', 26);
            $table->string ('shortname', 26)->nullable();
            $table->string ('typ', 2)->nullable();
            $table->timestamps();
            $table->index(['firstname','typ']);
            $table->index('shortname');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('firstnames');
    }
}
