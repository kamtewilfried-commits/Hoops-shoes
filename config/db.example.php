<?php
class Database {
    private static $host = 'localhost';
    private static $dbname = 'hoops_shoes_db';
    private static $username = 'root';
    private static $password = 'votre_mot_de_passe';
    private static $pdo;

    public static function getConnection() {
        if (!self::$pdo) {
            $dsn = "mysql:host=" . self::$host . ";dbname=" . self::$dbname . ";charset=utf8";
            self::$pdo = new PDO($dsn, self::$username, self::$password);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }
}