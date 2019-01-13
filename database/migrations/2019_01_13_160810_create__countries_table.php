<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->string('country_id', 2);
            $table->string('country', 30);
            $table->integer('weight');
            $table->timestamps();
            $table->unique('country_id');
            $table->index('country');
        });

        $_countries = [
            ['country_id'=>'UK', 'country'=>'Großbritannien', 'weight'=>60],
            ['country_id'=>'IE', 'country'=>'Irland', 'weight'=>4],
            ['country_id'=>'US', 'country'=>'Vereinigte Staaten', 'weight'=>150],
            ['country_id'=>'IT', 'country'=>'Italien', 'weight'=>60],
            ['country_id'=>'MT', 'country'=>'Malta', 'weight'=>1],
            ['country_id'=>'PT', 'country'=>'Portugal', 'weight'=>10],
            ['country_id'=>'ES', 'country'=>'Spanien', 'weight'=>40],
            ['country_id'=>'FR', 'country'=>'Frankreich', 'weight'=>60],
            ['country_id'=>'BE', 'country'=>'Belgien', 'weight'=>10],
            ['country_id'=>'LU', 'country'=>'Luxemburg', 'weight'=>1],
            ['country_id'=>'NL', 'country'=>'Niederlande', 'weight'=>14],
            ['country_id'=>'DE', 'country'=>'Deutschland', 'weight'=>80],
            ['country_id'=>'AT', 'country'=>'Österreich', 'weight'=>8],
            ['country_id'=>'CH', 'country'=>'Schweiz', 'weight'=>7],
            ['country_id'=>'IS', 'country'=>'Island', 'weight'=>1],
            ['country_id'=>'DK', 'country'=>'Dänemark', 'weight'=>5],
            ['country_id'=>'NO', 'country'=>'Norwegen', 'weight'=>4],
            ['country_id'=>'SE', 'country'=>'Schweden', 'weight'=>8],
            ['country_id'=>'FI', 'country'=>'Finnland', 'weight'=>5],
            ['country_id'=>'EE', 'country'=>'Estland', 'weight'=>2],
            ['country_id'=>'LV', 'country'=>'Lettland', 'weight'=>2],
            ['country_id'=>'LT', 'country'=>'Litauen', 'weight'=>3],
            ['country_id'=>'PL', 'country'=>'Polen', 'weight'=>35],
            ['country_id'=>'CZ', 'country'=>'Tschechische Republik', 'weight'=>8],
            ['country_id'=>'SK', 'country'=>'Slovakei', 'weight'=>7],
            ['country_id'=>'HU', 'country'=>'Ungarn', 'weight'=>11],
            ['country_id'=>'RO', 'country'=>'Rumänien', 'weight'=>22],
            ['country_id'=>'BG', 'country'=>'Bulgarien', 'weight'=>9],
            ['country_id'=>'BA', 'country'=>'Bosnien Herzegowina', 'weight'=>4],
            ['country_id'=>'HR', 'country'=>'Kroatien', 'weight'=>5],
            ['country_id'=>'XK', 'country'=>'Kosovo', 'weight'=>1],
            ['country_id'=>'MK', 'country'=>'Mazedonien', 'weight'=>2],
            ['country_id'=>'ME', 'country'=>'Montenegro', 'weight'=>1],
            ['country_id'=>'XS', 'country'=>'Serbien', 'weight'=>9],
            ['country_id'=>'SI', 'country'=>'Slovenien', 'weight'=>2],
            ['country_id'=>'AL', 'country'=>'Albanien', 'weight'=>3],
            ['country_id'=>'GR', 'country'=>'Griechenland', 'weight'=>10],
            ['country_id'=>'RU', 'country'=>'Russland', 'weight'=>100],
            ['country_id'=>'BU', 'country'=>'Belarus', 'weight'=>10],
            ['country_id'=>'MD', 'country'=>'Moldavien', 'weight'=>4],
            ['country_id'=>'UA', 'country'=>'Ukraine', 'weight'=>45],
            ['country_id'=>'AM', 'country'=>'Armenien', 'weight'=>3],
            ['country_id'=>'AZ', 'country'=>'Aserbaidschan', 'weight'=>4],
            ['country_id'=>'GE', 'country'=>'Georgien', 'weight'=>5],
            ['country_id'=>'KZ', 'country'=>'Kasachstan', 'weight'=>15],
            ['country_id'=>'TR', 'country'=>'Türkei', 'weight'=>55],
            ['country_id'=>'AE', 'country'=>'Vereinigte Arabische Emirate', 'weight'=>80],
            ['country_id'=>'IL', 'country'=>'Israel', 'weight'=>4],
            ['country_id'=>'CN', 'country'=>'China', 'weight'=>300],
            ['country_id'=>'IN', 'country'=>'Indien', 'weight'=>250],
            ['country_id'=>'JP', 'country'=>'Japan', 'weight'=>35],
            ['country_id'=>'KR', 'country'=>'Republik Korea', 'weight'=>12],
            ['country_id'=>'VN', 'country'=>'Vietnam', 'weight'=>17],
            ['country_id'=>'XX', 'country'=>'andere Länder', 'weight'=>1]
        ];
        $this->insertCountries ($_countries);
    }

    private function insertCountries (array $_countries) {
        foreach ($_countries as $_country) {
            $_objCountry = new \App\Country();
            foreach ( $_country as $_fieldname => $_value ) {
                $_objCountry->setAttribute( $_fieldname, $_value);
            }
            $_objCountry->save();
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries');
    }
}
