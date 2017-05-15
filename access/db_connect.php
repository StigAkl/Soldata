<?php

ini_set("log_errors", 1);
ini_set("error_log", dirname(__FILE__) . "/../error/err_log.txt");
error_reporting(E_ALL);

$ADMIN_EMAIL = "stg@hotmail.no";
class Db {
    private static $instance = NULL;

    private static $servername = "thenewworldproject.com.mysql";
    private static $username = "thenewworldproject_com_soldata";
    private static $password = "soldata";

    private function __construct() {
    }

    private function __clone() {}

    public static function getInstance() {
        if(!isset(self::$instane)) {

            try {
                $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
                self::$instance = new PDO("mysql:host=thenewworldproject.com.mysql;dbname=thenewworldproject_com_soldata", self::$username, self::$password);
            }catch (Exception $e) {
                error_log($e->getMessage());
            }
        }

        return self::$instance;
    }
}

?>