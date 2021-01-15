<?php
    declare(strict_types = 1);
    namespace src\database;
    
    use PDO;

class DBProvider {

        private static $_db;

        public static function get() : PDO {

            if(!self::$_db){
            
                $pdo = new PDO(
                    __CONFIG__['db']['host'],
                    __CONFIG__['db']['user'],
                    __CONFIG__['db']['pass']
                );
                $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
                $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE,PDO::FETCH_OBJ);
            
                self::$_db = $pdo;
            
            }

            return $pdo;
        }

    }