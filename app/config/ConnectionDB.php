<?php

namespace App\config;

class ConnectionDB
{
    private static $connection;
    
    public static function getConnection() 
    {
        if(!isset(self::$connection)){
            self::$connection = new \PDO(
                "mysql:host=".DB_HOST."; dbname=".DB_DATABASE.";charset=utf8", 
                DB_LOGIN, DB_PASSWORD
            );
        }

        return self::$connection;
    }
}

?>
