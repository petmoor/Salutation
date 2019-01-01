<?php

namespace PMoor\Core\Asset;

use PMoor\Core\Asset\Gender;

class Salutation extends Gender {

    public function __toString () {

        if ( $this->gender == 'f' ) return ( "Sehr geehrte Frau " );
        if ( $this->gender == 'm' ) return ( "Sehr geehrter Herr " );

        return ( "Sehr geehrte Damen und Herren" );
    }

}