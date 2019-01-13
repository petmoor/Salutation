<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFirstnametypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('firstnametypes', function (Blueprint $table) {
            $table->string('fnt_id', 2);
            $table->string('typ_of_firstname', 64);
            $table->timestamps();
            $table->primary('fnt_id');
        });

        $_Types = [
            'M' => 'männlich',
            '1M' => 'männlich, wenn erster Teil des Namens, sonst meist männlich',
            '?M' => 'unisex, aber meist männlich',
            'F' => 'weiblich',
            '1F' => 'weiblich, wenn erster Teile des Namens, sonst meist weiblich',
            '?F' => 'unisex, aber meist weiblich',
            '?' => 'unisex'
        ];
        $this->postInsert ($_Types);
    }

    private function postInsert (array $_Types) {
        foreach ($_Types as $_primary_id => $_Type) {
            $FN_typ = new \App\Firstnametype ();
            $FN_typ->setAttribute('fnt_id', $_primary_id);
            $FN_typ->setAttribute('typ_of_firstname', $_Type);
            $FN_typ->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('firstnametypes');
    }
}
