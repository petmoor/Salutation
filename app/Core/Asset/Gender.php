<?php

namespace PMoor\Core\Asset;

class Gender {

    protected $gender=null;

    public function __construct ( ?string $_gender=null ) {
        if ( $_gender == "f" || $_gender == "m" ) $this->gender = $_gender;
    }

    public function __set ( $_name, $_value ) {
        $this->{$_name} = $_value;
    }

    public function __toString () {
        return $this->gender;
    }

}