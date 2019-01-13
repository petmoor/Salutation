<?php

namespace PMoor;

class AppClassLoader {

    public static function load ( $_class_name ) {

        if ( strpos($_class_name, __NAMESPACE__) !== 0 ) return ( false );  // Autoload not for searched namespace

        // Delete basic namespace. It's no pathname.
        $_class_name = substr ($_class_name, strlen(__NAMESPACE__) );

        // Build class filename
        $_nspaces = explode ( "\\", $_class_name);
        $_classpath = __PHP_DIR__ . DIRECTORY_SEPARATOR . implode ( DIRECTORY_SEPARATOR, $_nspaces) . ".php";
        if ( file_exists($_classpath) ) {
            require_once ( $_classpath );
        }
        else {
            return ( false );
        }
    }

}

spl_autoload_register ( __NAMESPACE__ . "\AppClassLoader::load" );

