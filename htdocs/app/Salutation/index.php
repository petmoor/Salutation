<?php

// start autoloading
define ( "__PHP_DIR__", "..\\..\\..\\app\\" );
require_once ( __PHP_DIR__ . "ClassLoader.php");

// Usages
use PMoor\Salutation\Globals;
use PMoor\Core\Asset\Salutation;
use PMoor\Core\Asset\Gender;

$_salut = new Salutation ();

echo $_salut . "<br>";

$_salut->gender = 'f';
echo $_salut . "<br>";

$_salut->gender = 'm';
echo $_salut . "<br>";

