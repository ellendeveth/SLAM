<?php
    abstract class Security
    {
        public static function onlyLoggedInUsers()
        {
            session_start();
            if (!isset($_SESSION['id'])) {
                header("Location: login.php");
            }
        }
    }
