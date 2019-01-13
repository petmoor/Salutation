<?php

// start autoloading
define ( "__PHP_DIR__", "..\\..\\..\\app\\" );
require_once ( __PHP_DIR__ . "ClassLoader.php");

// Usages
use PMoor\Salutation\Globals;
use PMoor\Salutation\Database;
use PMoor\Core\Asset\Salutation;
use PMoor\Core\Asset\Gender;
use PMoor\Core\Asset\Country;

// connect database Salutation
$_db = new Database();

$_salut = new Salutation ();

echo $_salut . "<br>";

$_salut->gender = 'f';
echo $_salut . "<br>";

$_salut->gender = 'm';
echo $_salut . "<br>";

$_country = new Country($_db);

$_country->get (1);
echo $_country->country_indicator . " = " . $_country->country . "<br>";

$_country->get ("DE");
echo $_country->country_indicator . " = " . $_country->country . "<br>";
