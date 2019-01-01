<?php

namespace PMoor\Salutation;
use PMoor\Salutation\Globals;

class Database extends \PDO {

    public $db = null;

    public function __construct () {
                
        $_db = null;
        $_db_connect = 'mysql:dbname=' . Globals::DB_NAME . ';host=' . Globals::DB_HOST;

        try {
            $_db = parent::__construct($_db_connect, Globals::DB_USER, Globals::DB_PWORD);
        } catch (PDOException $e) {
            //echo 'Connection failed: ' . $e->getMessage() . PHP_EOL ;
            return null;
        }
        $this->db = $_db;
        return $this;
    }

    public function close () :bool {
        $this->db = null;
        return true;
    }

}