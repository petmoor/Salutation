<?php

// start autoloading
define ( "__PHP_DIR__", "..\\..\\..\\" );
require_once ( __PHP_DIR__ . "ClassLoader.php");

// GLOBALS
define ( "FN_LENGTH", 26 );

// Usages
use PMoor\Salutation\Globals;



function addFirstName ( PDO $_pdo, string $_firstname, string $_shortname, string $_typ, array $_weights ) {
    $_ret = false;

    $_ins = $_pdo->prepare("INSERT INTO FirstNames (firstname, shortname, typ, created_at, updated_at) VALUES (:firstname, :shortname, :typ, now(), now())");
    $_ins->bindParam (':firstname', $_firstname );
    $_ins->bindParam (':shortname', $_shortname );
    $_ins->bindParam (':typ', $_typ );
    if ($_ins->execute ()) {
        $_id = $_pdo->lastInsertId();
        echo '.';
        //echo $_id . ": " . $_firstname . PHP_EOL;

        addFirstNameWeights ($_pdo, $_id, $_weights);

        $_ret = true;             
    }
 
    return ( $_ret );
}

function addFirstNameWeights (PDO $_pdo, int $_id, array $_weights) {
    foreach ( $_weights as $_item ) {
        foreach ( $_item as $_country_indicator => $_weight ) {

            $_sql = $_pdo->prepare("SELECT * FROM FirstNames_Country_Weight where fn_id=:fn_id and country_indicator=:country_indicator");
            $_sql->bindParam(':fn_id', $_id, PDO::PARAM_INT );
            $_sql->bindParam(':country_indicator', $_country_indicator );
            $_sql->execute ();
            if ( !$_sql->fetch(PDO::FETCH_ASSOC) ) {
                $_ins = $_pdo->prepare("INSERT INTO FirstNames_Country_Weight (fn_id, country_indicator, firstname_weight, created_at, updated_at) VALUES (:fn_id, :country_indicator, :firstname_weight, now(), now())");
                $_ins->bindParam(':fn_id', $_id, PDO::PARAM_INT );
                $_ins->bindParam(':country_indicator', $_country_indicator );
                $_ins->bindParam(':firstname_weight', $_weight, PDO::PARAM_INT );
                echo ($_ins->execute ()) ? '.' :  '-';
            }

        }
    }   
}




$_db_connect = 'mysql:dbname=' . Globals::DB_NAME . ';host=' . Globals::DB_HOST;

try {
    $_pdo = new PDO ($_db_connect, Globals::DB_USER, Globals::DB_PWORD );
} catch (PDOException $e) {
    echo 'Connection failed: ' . $e->getMessage() . PHP_EOL ;
    return;
}

// delete FirstNames
$_del = 'DELETE FROM FirstNames';
if ( $_pdo->exec($_del) !== false ) {
    echo '.';
}
else {
    echo PHP_EOL . $_del .PHP_EOL;
}

// delete FirstNames_Country_Weight
$_del = 'DELETE FROM FirstNames_Country_Weight';
if ( $_pdo->exec($_del) !== false ) {
    echo '.';
}
else {
    echo PHP_EOL . $_del .PHP_EOL;
}


// Insert tables: FirstNames / FirstNames_Country_Weight
$_fd_firstnames = fopen (".\\nam_dict_utf8.txt", "r");
//$_fd_firstnames = fopen (".\\nam_dict_utf8_short.txt", "r");
if ( $_fd_firstnames) {

    while (($_line = fgets($_fd_firstnames)) !== false ) {
        
        $_line = trim(str_replace( "\r", "", str_replace("\n", "", $_line)));
        $_weights = array ();
        //echo "LINE: |{$_line}|" . PHP_EOL;
        if ( $_line != "" && $_line[0] != "#" ) {

            // ignore lines with '+' on column 30
            if ( $_line[30] == '+' ) continue;

            // Vornamen einlesen.
            $_typ       = trim(substr($_line, 0, 2));
            $_firstname = trim(substr($_line, 3, FN_LENGTH));
            $_shortname = "";
            if ( $_typ == '=' ) {
                // Abkürzung vorhanden
                $_names = explode( " ", $_firstname );
                if ( count($_names) == 2) {
                    $_shortname = $_names[0];
                    $_firstname = $_names[1];
                }
            }

            // country weights 
            $_pos=30;
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('UK' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('IE' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('US' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('IT' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('MT' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('PT' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('ES' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('FR' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('BE' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('LU' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('NL' => intval(hexdec($_line[$_pos])))); $_pos++; //
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('DE' => intval(hexdec($_line[$_pos])))); $_pos++; // insert Ostfriesland as Germany
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('DE' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('AT' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('CH' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('IS' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('DK' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('NO' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('SE' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('FI' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('EE' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('LV' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('LT' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('PL' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('CZ' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('SK' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('HU' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('RO' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('BG' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('BA' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('HR' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('XK' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('MK' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('ME' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('XS' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('SI' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('AL' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('GR' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('RU' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('BU' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('MD' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('UA' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('AM' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('AZ' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('GE' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('KZ' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('TR' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('AE' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('IL' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('CN' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('IN' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('JP' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('KR' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('VN' => intval(hexdec($_line[$_pos])))); $_pos++; // 
            if (isset($_line[$_pos]) && $_line[$_pos] != ' ') array_push ( $_weights, array('XX' => intval(hexdec($_line[$_pos])))); $_pos++; // 


            $_seperator = '+';
            while ( $_seperator != '' ) {

                // replase seperator '+' with three version of firstname
                // e.g. "Jun+Wei" represents the names "Jun-Wei", "Jun Wei" and "Junwei".
                if ( strpos ( $_firstname, $_seperator) !== false) {
                    //echo '+ found.' . PHP_EOL;
                    switch ( $_seperator ) {
                    case '+':
                        $_seperator = '-';
                        $_firstname = str_replace ( '+', $_seperator, $_firstname );
                        break;
                    case '-':
                        $_seperator = ' ';
                        $_firstname = str_replace ( '-', $_seperator, $_firstname );
                        break;
                    case ' ':
                        $_seperator = '';
                        $_firstname = str_replace ( ' ', $_seperator, $_firstname );
                        break;
                    }
                }
                else {
                    $_seperator = '';
                }

                //echo "Name: " . $_firstname . " Typ: " . $_typ . PHP_EOL;
                if ( !addFirstName ( $_pdo, $_firstname, $_shortname, $_typ, $_weights) ) {

                    $_sql = $_pdo->prepare("SELECT * FROM FirstNames where Firstname=:firstname");
                    $_sql->bindParam(':firstname', $_firstname );
                    $_sql->execute ();
                    if ( ($_value = $_sql->fetch(PDO::FETCH_ASSOC)) ) {
                        addFirstNameWeights ($_pdo, intval($_value["fn_id"]), $_weights);
                    }
                    else {
                        //echo '-';
                        echo "FAIL - Firstname: " . $_firstname . " Typ: " . $_typ . PHP_EOL;
                        echo $_line . PHP_EOL;                        
                    }

                }
            }
        }
    }

    fclose ( $_fd_firstnames );
}
else {
    echo "Cannot load \'nam_dict.txt\' file.". PHP_EOL ;
}

// Insert tables: Firstnames_Russia / Countries / Phonetic_Rules
echo 'Fülle die Tabelle \'Countries\'...' . PHP_EOL ;
$_fd_populate_script = fopen(".\populate_Salutation_DB.sql", "r");
if ($_fd_populate_script) {
    $_skip = 0;
    while (($_line = fgets($_fd_populate_script)) !== false) {
        $_line = trim(str_replace( "\r", "", str_replace("\n", "", $_line)));
        //echo "LINE: |{$_line}|" . PHP_EOL;
        if ( $_line != "" ) {
            if ( strpos ($_line, '/*') !== false ) $_skip++;

            if ( $_skip == 0 ) {
                // execute SQL-Statment
                if ( $_pdo->exec($_line) !== false ) {
                    echo '.';
                }
                else {
                   // echo PHP_EOL . $_line .PHP_EOL;
                }
            }

            if ( strpos ($_line, '*/') !== false ) $_skip--;
        }
    }

    fclose($_fd_populate_script);
} else {
    echo "Cannot load \'populate_Salutation_DB.sql\' script.". PHP_EOL ;
} 

// Add russian synonyms to firstname table
$_sql = $_pdo->prepare("SELECT FR.firstname, F.fn_id, F.shortname, F.typ FROM Firstnames_Russia as FR INNER JOIN Firstnames as F ON FR.fn_id=F.fn_id");
$_sql->execute ();
while ( ($_value = $_sql->fetch(PDO::FETCH_ASSOC)) ) {
    $_weights = array ();
    $_sql_weight = $_pdo->prepare("SELECT * FROM FirstNames_Country_Weight where fn_id=:fn_id");
    $_sql_weight->bindParam(':fn_id', $_value["fn_id"], PDO::PARAM_INT );
    $_sql_weight->execute ();
    while ( ($_value_weight = $_sql_weight->fetch(PDO::FETCH_ASSOC)) ) {
        array_push ( $_weights, array($_value_weight["country_indicator"] => $_value_weight["firstname_weight"]) );
    }
    addFirstName ( $_pdo, $_value["firstname"], $_value["shortname"], $_value["typ"], $_weights);
}

echo PHP_EOL;
echo PHP_EOL;
echo 'Population DONE.' . PHP_EOL . PHP_EOL;

$_pdo = null;
