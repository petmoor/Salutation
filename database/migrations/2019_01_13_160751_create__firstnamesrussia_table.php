<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirstnamesrussiaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firstnamesrussia', function (Blueprint $table) {
            $table->increments('fnr_id');
            $table->integer('fn_id');
            $table->string('firstname', 26);
            $table->timestamps();
            $table->index('fn_id');
            $table->index('firstname');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('firstnamesrussia');
    }
}
