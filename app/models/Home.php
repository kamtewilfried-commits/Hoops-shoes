<?php
require_once 'config/db.php';

class Home
{
    public static function getSoulier()
    {
        $pdo = Database::getConnection();
        $stmt = $pdo->query("SELECT * FROM souliers");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
