<?php
class DataBase {
    private static $conn = null;
    
    public static function connect() {
        if (DataBase::$conn === null) {
            DataBase::$conn = new PDO("mysql:host=localhost;dbname=frases_Grdz_Rafa", "root", "Rafa2025@", [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }
        return DataBase::$conn;
    }
}
?>
