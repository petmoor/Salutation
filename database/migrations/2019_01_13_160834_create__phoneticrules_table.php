<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhoneticrulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phoneticrules', function (Blueprint $table) {
            $table->increments('phr_id');
            $table->string('syllable', 3);
            $table->string('phonetic', 3);
            $table->integer('difference');
            $table->integer('hash_group');
            $table->timestamps();
            $table->index('syllable');
        });

        $_phonetics = [
            ['syllable'=>'IJ',  'phonetic'=>'I',      'difference'=>10,  'hash_group'=>1],
            ['syllable'=>'IJ',  'phonetic'=>'J',      'difference'=>30,  'hash_group'=>1],
            ['syllable'=>'IY',  'phonetic'=>'I',      'difference'=>10,  'hash_group'=>1],
            ['syllable'=>'IY',  'phonetic'=>'Y',      'difference'=>30,  'hash_group'=>1],
            ['syllable'=>'I',   'phonetic'=>'J',      'difference'=>30,  'hash_group'=>1],
            ['syllable'=>'I',   'phonetic'=>'Y',      'difference'=>30,  'hash_group'=>1],
            ['syllable'=>'J',   'phonetic'=>'Y',      'difference'=>20,  'hash_group'=>1],
            ['syllable'=>'IE',  'phonetic'=>'I',       'difference'=>5,  'hash_group'=>1],
            ['syllable'=>'IE',  'phonetic'=>'',      'difference'=>120,  'hash_group'=>1],
            ['syllable'=>'EU',  'phonetic'=>'OI',     'difference'=>10,  'hash_group'=>2],
            ['syllable'=>'EU',  'phonetic'=>'OY',     'difference'=>10,  'hash_group'=>2],
            ['syllable'=>'OI',  'phonetic'=>'OY',      'difference'=>5,  'hash_group'=>2],
            ['syllable'=>'OU',  'phonetic'=>'U',       'difference'=>5,  'hash_group'=>2],
            ['syllable'=>'AH',  'phonetic'=>'A',       'difference'=>5,  'hash_group'=>3],
            ['syllable'=>'H',   'phonetic'=>'',       'difference'=>50,  'hash_group'=>3],
            ['syllable'=>'Å',   'phonetic'=>'AA',      'difference'=>0,  'hash_group'=>3],
            ['syllable'=>'Ä',   'phonetic'=>'AE',      'difference'=>0,  'hash_group'=>3],
            ['syllable'=>'Ä',   'phonetic'=>'A',      'difference'=>40,  'hash_group'=>3],
            ['syllable'=>'AE',  'phonetic'=>'A',      'difference'=>60,  'hash_group'=>3],
            ['syllable'=>'Ä',   'phonetic'=>'E',      'difference'=>20,  'hash_group'=>4],
            ['syllable'=>'Æ',   'phonetic'=>'E',      'difference'=>20,  'hash_group'=>4],
            ['syllable'=>'A',   'phonetic'=>'ER',     'difference'=>70,  'hash_group'=>4],
            ['syllable'=>'AE',  'phonetic'=>'E',      'difference'=>20,  'hash_group'=>4],
            ['syllable'=>'AE',  'phonetic'=>'',      'difference'=>110,  'hash_group'=>4],
            ['syllable'=>'AI',  'phonetic'=>'AY',      'difference'=>5,  'hash_group'=>4],
            ['syllable'=>'AI',  'phonetic'=>'EI',      'difference'=>5,  'hash_group'=>4],
            ['syllable'=>'AI',  'phonetic'=>'EY',     'difference'=>10,  'hash_group'=>4],
            ['syllable'=>'AY',  'phonetic'=>'EI',     'difference'=>10,  'hash_group'=>4],
            ['syllable'=>'AY',  'phonetic'=>'EY',      'difference'=>5,  'hash_group'=>4],
            ['syllable'=>'EI',  'phonetic'=>'EY',      'difference'=>5,  'hash_group'=>4],
            ['syllable'=>'Å',   'phonetic'=>'O',      'difference'=>70,  'hash_group'=>5],
            ['syllable'=>'Ö',   'phonetic'=>'OE',      'difference'=>0,  'hash_group'=>5],
            ['syllable'=>'Ö',   'phonetic'=>'O',      'difference'=>40,  'hash_group'=>5],
            ['syllable'=>'Ø',   'phonetic'=>'Ö',       'difference'=>0,  'hash_group'=>5],
            ['syllable'=>'Ø',   'phonetic'=>'OE',     'difference'=>10,  'hash_group'=>5],
            ['syllable'=>'Ø',   'phonetic'=>'O',      'difference'=>30,  'hash_group'=>5],
            ['syllable'=>'Œ',   'phonetic'=>'Ö',       'difference'=>5,  'hash_group'=>5],
            ['syllable'=>'Œ',   'phonetic'=>'OE',      'difference'=>0,  'hash_group'=>5],
            ['syllable'=>'OE',  'phonetic'=>'O',      'difference'=>60,  'hash_group'=>5],
            ['syllable'=>'OE',  'phonetic'=>'',      'difference'=>110,  'hash_group'=>5],
            ['syllable'=>'CHS', 'phonetic'=>'X',     'difference'=>100,  'hash_group'=>6],
            ['syllable'=>'CKS', 'phonetic'=>'X',      'difference'=>30,  'hash_group'=>6],
            ['syllable'=>'CK',  'phonetic'=>'K',       'difference'=>5,  'hash_group'=>6],
            ['syllable'=>'C',   'phonetic'=>'K',      'difference'=>30,  'hash_group'=>6],
            ['syllable'=>'CHS', 'phonetic'=>'',      'difference'=>200,  'hash_group'=>6],
            ['syllable'=>'CH',  'phonetic'=>'',      'difference'=>130,  'hash_group'=>6],
            ['syllable'=>'CKS', 'phonetic'=>'',      'difference'=>200,  'hash_group'=>6],
            ['syllable'=>'CK',  'phonetic'=>'',      'difference'=>110,  'hash_group'=>6],
            ['syllable'=>'DT',  'phonetic'=>'T',       'difference'=>5,  'hash_group'=>7],
            ['syllable'=>'D',   'phonetic'=>'T',      'difference'=>30,  'hash_group'=>7],
            ['syllable'=>'TH',  'phonetic'=>'T',       'difference'=>5,  'hash_group'=>7],
            ['syllable'=>'DT',  'phonetic'=>'',      'difference'=>110,  'hash_group'=>7],
            ['syllable'=>'KS',  'phonetic'=>'X',       'difference'=>5,  'hash_group'=>8],
            ['syllable'=>'GS',  'phonetic'=>'X',      'difference'=>10,  'hash_group'=>8],
            ['syllable'=>'G',   'phonetic'=>'K',      'difference'=>50,  'hash_group'=>8],
            ['syllable'=>'QU',  'phonetic'=>'KW',     'difference'=>10,  'hash_group'=>8],
            ['syllable'=>'Q',   'phonetic'=>'K',      'difference'=>10,  'hash_group'=>8],
            ['syllable'=>'NCH', 'phonetic'=>'NSCH',   'difference'=>10,  'hash_group'=>9],
            ['syllable'=>'NCH', 'phonetic'=>'NSH',    'difference'=>10,  'hash_group'=>9],
            ['syllable'=>'NTX', 'phonetic'=>'NCH',    'difference'=>20,  'hash_group'=>9],
            ['syllable'=>'NTX', 'phonetic'=>'NSCH',   'difference'=>20,  'hash_group'=>9],
            ['syllable'=>'NTX', 'phonetic'=>'NSH',    'difference'=>20,  'hash_group'=>9],
            ['syllable'=>'NG',  'phonetic'=>'NK',     'difference'=>20,  'hash_group'=>9],
            ['syllable'=>'ß',   'phonetic'=>'SS',      'difference'=>0, 'hash_group'=>10],
            ['syllable'=>'ß',   'phonetic'=>'S',       'difference'=>5, 'hash_group'=>10],
            ['syllable'=>'SCH', 'phonetic'=>'SH',      'difference'=>5, 'hash_group'=>10],
            ['syllable'=>'SCH', 'phonetic'=>'SZ',     'difference'=>20, 'hash_group'=>10],
            ['syllable'=>'SCH', 'phonetic'=>'S',     'difference'=>100, 'hash_group'=>10],
            ['syllable'=>'SCH', 'phonetic'=>'',      'difference'=>200, 'hash_group'=>10],
            ['syllable'=>'TZ',  'phonetic'=>'Z',       'difference'=>5, 'hash_group'=>11],
            ['syllable'=>'TIA', 'phonetic'=>'ZIA',    'difference'=>20, 'hash_group'=>11],
            ['syllable'=>'Z',   'phonetic'=>'C',      'difference'=>40, 'hash_group'=>11],
            ['syllable'=>'Z',   'phonetic'=>'S',      'difference'=>50, 'hash_group'=>11],
            ['syllable'=>'M',   'phonetic'=>'N',      'difference'=>70, 'hash_group'=>12],
            ['syllable'=>'N',   'phonetic'=>'U',      'difference'=>70, 'hash_group'=>12],
            ['syllable'=>'PH',  'phonetic'=>'F',       'difference'=>5, 'hash_group'=>13],
            ['syllable'=>'PF',  'phonetic'=>'F',       'difference'=>5, 'hash_group'=>13],
            ['syllable'=>'B',   'phonetic'=>'P',      'difference'=>40, 'hash_group'=>13],
            ['syllable'=>'F',   'phonetic'=>'V',      'difference'=>20, 'hash_group'=>14],
            ['syllable'=>'W',   'phonetic'=>'V',      'difference'=>20, 'hash_group'=>14],
            ['syllable'=>'Ü',   'phonetic'=>'UE',      'difference'=>0, 'hash_group'=>15],
            ['syllable'=>'Ü',   'phonetic'=>'U',      'difference'=>40, 'hash_group'=>15],
            ['syllable'=>'Ü',   'phonetic'=>'Y',      'difference'=>30, 'hash_group'=>15],
            ['syllable'=>'UE',  'phonetic'=>'U',      'difference'=>60, 'hash_group'=>15],
            ['syllable'=>'UE',  'phonetic'=> '',      'difference'=>110, 'hash_group'=>15]            
        ];

        $this->insertPhonetics ($_phonetics);
    }

    private function insertPhonetics (array $_phonetics) {
        foreach ($_phonetics as $_phonetic) {
            $_objPhonetic = new \App\PhoneticRule();
            foreach ( $_phonetic as $_fieldname => $_value ) {
                $_objPhonetic->setAttribute( $_fieldname, $_value);
            }
            $_objPhonetic->save();
        }
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phoneticrules');
    }
}
