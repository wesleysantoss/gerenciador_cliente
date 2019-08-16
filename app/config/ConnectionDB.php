<?php

namespace App\config;

class ConnectionDB
{
    private static $connection;
    
    private function __construct()
    {
        //
    }

    public static function getConnection() 
    {
        if(!isset(self::$connection)){
            try {
                self::$connection = new \PDO(
                    DB_DRIVER .":host=".DB_HOST."; dbname=".DB_DATABASE.";charset=utf8", 
                    DB_LOGIN, DB_PASSWORD
                );
            } catch (PDOException  $e){
                echo $e->getMessage();
            }
        }

        return self::$connection;
    }
}

?>
