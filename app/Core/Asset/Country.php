<?php

namespace PMoor\Core\Asset;
use PMoor\Core\Interfaces\Model;
use PMoor\Salutation\Database;

class Country implements Model {

    private $pdo              = null;
    public  $c_id             = 0;
    public  $country_indicator= '';
    public  $country          = '';
    public  $country_weight   = 0;

    public function __construct (Database $pdo) {
        if ( $pdo instanceof Database ) $this->pdo = $pdo;
    }

    public function get ($_value) :bool {
        if ( $this->pdo == null ) return false;     // no database connect

        if ( is_int($_value) ) {
            $_sql = $this->pdo->prepare ("SELECT * FROM Countries WHERE c_id=:c_id");
            $_sql->bindParam (":c_id", $_value, \PDO::PARAM_INT );
            $_sql->execute();
            if ( ($_value = $_sql->fetch(\PDO::FETCH_ASSOC)) ) {
                if ( isset($_value["c_id"]) ) {
                    $this->c_id                = $_value["c_id"];
                    $this->country_indicator   = $_value["country_indicator"];
                    $this->country             = $_value["country"];
                    $this->country_weight      = $_value["country_weight"];
                    return true;
                }
            }
            return false;
        }
        if ( is_string($_value)) {
            $_sql = $this->pdo->prepare ("SELECT * FROM Countries WHERE country_indicator=:country_indicator");
            $_sql->bindParam (":country_indicator", $_value );
            $_sql->execute();
            if ( ($_value = $_sql->fetch(\PDO::FETCH_ASSOC)) ) {
                if ( isset($_value["c_id"]) ) {
                    $this->c_id                = $_value["c_id"];
                    $this->country_indicator   = $_value["country_indicator"];
                    $this->country             = $_value["country"];
                    $this->country_weight      = $_value["country_weight"];
                    return true;
                }
            }
            return false;
        }
        return false;
    }

    public function save () :bool  {
        if ( $this->pdo == null ) return false;     // no database connect
        if ( $this->id > 0 ) {

            return true;
        }
        return false;
    }

    public function del () :bool  {
        if ( $this->pdo == null ) return false;     // no database connect
        return true;
    }

    public function validate () :bool {
        return true;
    }
}