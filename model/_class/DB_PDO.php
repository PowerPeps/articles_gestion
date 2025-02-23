<?php
abstract class DB_PDO
{
    protected static $pdo;

//    public function __construct()
//    {
//        if (self::$pdo === null) {
//            self::$pdo = new PDO(constant('USER_DB_CONNECT'), constant('USER_DB_USER'), constant('USER_DB_PASSWORD'));
//        }
//    }

    public function __construct($DB_CONNECT, $DB_USER, $DB_PASSWORD)
    {
        if (self::$pdo === null) {
            self::$pdo = new PDO($DB_CONNECT, $DB_USER, $DB_PASSWORD);
        }
    }
}