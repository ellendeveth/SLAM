<?php
    abstract class Db
    {
        private static $conn;

        public static function getInstance()
        {
            if (self::$conn != null) {
                // Return existing connection
                return self::$conn;
            } else {
                // New connection
                $config = parse_ini_file($_SERVER["DOCUMENT_ROOT"] . "/SLAM/config/config.ini");
                self::$conn = new PDO('mysql:host='. $config['db_host'] .';dbname=' . $config['db_name'] . ";charset=utf8mb4", $config['db_user'], $config['db_password']);
                return self::$conn;
            }
        }
    }
